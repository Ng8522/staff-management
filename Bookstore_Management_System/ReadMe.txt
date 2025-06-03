Admin Account:
email: admin@example.com
password: Adm123

To start the project:
- to run the server, please install java jdk-17
- open 'About your PC' open Advanced Configuration then create a new environment variable name 'JAVA_HOME' which is your java jdk-17 path
- in Advanced Configuration, modify the Path by adding '%JAVA_HOME%/bin'
- to run the python server, please download https://www.microsoft.com/store/productId/9NRWMJP3717K?ocid=pdpshare, Python 3.11.
- run the python, open 'DailyEmailSchedule.py' and right click to "Run Python > Run Python in Terminal"
- Please ensure u run the 'sendgrid-email-service' by open it with vscode/ new command prompt window by using 'mvnw spring-boot:run' to ensure the SendGrid email web service can be run, if not u cannot reset the password by receive the email reset link
- To check the 'sendgrid-email-service' project is run, look at the xampp control panel. If the Tomcat is running and the port is on 8080, which means the project is run successfully
- If u register a new staff account, the password is same with the email