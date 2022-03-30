<?php

namespace App\Shared\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AppController extends AbstractFOSRestController
{
    /**
     * @return View
     */
    protected function handleViewGroups(View $view, array $groups)
    {
        $context = new \FOS\RestBundle\Context\Context();
        $context->setGroups($groups);
        $view->setContext($context);

        return $view;
    }

    /**
     * @param $form
     *
     * @return array
     */
    protected function getFormErrorMessages($form)
    {
        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if ($child->isSubmitted() && !$child->isValid()) {
                $errors[$child->getName()] = $this->getFormErrorMessages($child);
            }
        }

        return $errors;
    }

    protected function formValidationErrorResponse(FormInterface $form): Response
    {
        return $this->handleView($this->view($this->getFormErrorMessages($form), Response::HTTP_BAD_REQUEST));
    }

    protected function jsonResponse(
        string $message = '',
        $data = null,
        int $status = Response::HTTP_OK,
        array $headers = []
    ) {
        $payload = [];

        if ('' !== $message) {
            $payload['message'] = $message;
        }

        if ($data) {
            $payload['data'] = $data;
        }

        return new JsonResponse($payload, $status, $headers);
    }
}
