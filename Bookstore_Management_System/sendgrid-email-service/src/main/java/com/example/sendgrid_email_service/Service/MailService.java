package com.example.sendgrid_email_service.Service;

import java.io.IOException;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

import com.sendgrid.Content;
import com.sendgrid.Email;
import com.sendgrid.Mail;
import com.sendgrid.Method;
import com.sendgrid.Request;
import com.sendgrid.Response;
import com.sendgrid.SendGrid;

/**
 * File Name: MailService.java
 * Description: Implemented to send password reset emails using SendGrid, allowing users to receive a reset link via email.
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package  Service
 */

@Service
public class MailService {
	private static final Logger logger = LoggerFactory.getLogger(MailService.class);
	
	public String sendTextEmail(String ReceiverEmail, String ResetLink) throws IOException {
		    Email from = new Email("junyu8522@gmail.com");
		    String subject = "Reset your password";
		    Email to = new Email(ReceiverEmail);
		    Content content = new Content("text/plain", "Click here to reset your password: " + ResetLink);
		    Mail mail = new Mail(from, subject, to, content);
		
		    SendGrid sg = new SendGrid("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");
		    Request request = new Request();
		    try {
		      request.setMethod(Method.POST);
		      request.setEndpoint("mail/send");
		      request.setBody(mail.build());
		      Response response = sg.api(request);
		      logger.info(response.getBody());
		      return response.getBody();	     
		    } catch (IOException ex) {
		      throw ex;
		    }	   
	}
}