package com.example.sendgrid_email_service;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
/**
 * File Name: SendgridEmailServiceApplication.java
 * Description: serves as the entry point for the Spring Boot application, launching the SendGrid email service application when the main method is executed.
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 */
@SpringBootApplication
public class SendgridEmailServiceApplication {

	public static void main(String[] args) {
		SpringApplication.run(SendgridEmailServiceApplication.class, args);
	}

}
