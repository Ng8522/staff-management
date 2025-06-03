package com.example.sendgrid_email_service;
import java.io.IOException;

import com.example.sendgrid_email_service.Service.MailService;
import org.springframework.web.bind.annotation.*;
import org.springframework.http.ResponseEntity;
import org.springframework.http.HttpStatus;
import java.util.Map;

/**
 * File Name: EmailController.java
 * Description: handles HTTP POST requests for sending password reset emails, using the MailService to send emails with a reset link, and returns appropriate HTTP responses based on success or failure.
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 */

@RestController
@RequestMapping("/send-email")
public class EmailController {

    private final MailService mailService;

    public EmailController(MailService mailService) {
        this.mailService = mailService;
    }

    @PostMapping("/reset-password")
    public ResponseEntity<String> sendResetEmail(@RequestBody Map<String, String> payload) {
        String receiverEmail = payload.get("email");
        String resetLink = payload.get("resetLink");
        try {
            String response = mailService.sendTextEmail(receiverEmail, resetLink);
            return ResponseEntity.ok(response);
        } catch (IOException e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body("Failed to send email: " + e.getMessage());
        }
    }

    
}

