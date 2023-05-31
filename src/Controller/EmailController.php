<?php

namespace App\Controller;

use App\Service\EmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * @Route("/api/email")
 */
class EmailController extends AbstractController
{

    private EmailService $emailService;

    public function __construct(
        EmailService $emailService
    )
    {
        $this->emailService = $emailService;
    }

    /**
     * @Route("/send", name="email_send")
     */
    public function index(Request $request, MailerInterface $mailer): JsonResponse
    {
        if (!$emailSent = $this->emailService->createEmailSent(json_decode($request->getContent()))) {
            return $this->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => 'Email is missing \'to\', \'subject\' or \'text\'.',
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $emailSentDB = $this->emailService->sendEmail($emailSent);

            if (!$emailSentDB->getId()) {
                return $this->json(
                    [
                        'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                        'message' => 'Error while sending email to ' . $emailSent->getToEmail(),
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }

            return $this->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Email sent to ' . $emailSentDB->getToEmail(),
                    'email' => $emailSentDB,
                ],
                Response::HTTP_OK,
                [],
                [AbstractNormalizer::GROUPS => ['view']]
            );
        } catch (\Exception|TransportExceptionInterface $e) {
            return $this->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Error while sending email to ' . $emailSent->getToEmail(),
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
