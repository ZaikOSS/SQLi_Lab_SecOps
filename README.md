Here is a README file generated for the SQLi lab repository.

-----

# SQLi Lab for SecOps

This project provides a simple, containerized web application vulnerable to SQL injection. It is intended for educational and demonstration purposes, allowing users to safely practice identifying and exploiting SQLi vulnerabilities.

The application consists of a simple PHP login page connected to a MySQL database.

-----

## 🚀 Setup & Installation

This lab is built to run with Docker and Docker Compose, making setup quick and easy.

1.  **Prerequisites:**

      * [Docker](https://docs.docker.com/get-docker/)
      * [Docker Compose](https://docs.docker.com/compose/install/) (often included with Docker Desktop)

2.  **Clone the repository:**

    ```bash
    git clone https://github.com/ZaikOSS/SQLi_Lab_SecOps.git
    cd SQLi_Lab_SecOps
    ```

3.  **Build and run the containers:**

    ```bash
    docker-compose up -d --build
    ```

4.  **Access the Lab:**
    Once the containers are running, you can access the vulnerable login page in your browser at:
    [http://localhost:8080](https://www.google.com/search?q=http://localhost:8080)

-----

## 🎯 How to Exploit

The login page is vulnerable to a basic SQL injection attack. The `password` field does not properly sanitize user input.

### Example 1: Manual Bypass

You can bypass the login authentication by using a simple tautology (a statement that is always true) in the password field.

  * **Username:** `admin` (or any user)
  * **Password:** `' OR '1'='1`

When this is entered, the backend SQL query becomes something like this:

```sql
SELECT * FROM users WHERE username = 'admin' AND password = '' OR '1'='1';
```

Since `'1'='1'` is **always true**, the `OR` condition makes the entire `WHERE` clause true, and the database returns the first user, logging you in without a valid password.

### Example 2: Using sqlmap

You can also use the automated SQL injection tool [sqlmap](https://sqlmap.org/) to exploit this vulnerability and dump the database contents.

**Note:** This command assumes you have sqlmap installed.

```bash
sqlmap -u "http://localhost:8080/" \
 --data="username=test&password=test&login=Login" \
 -p password \
 --dbs --tables --columns --dump \
 --exclude-sysdbs --batch
```

**Command Breakdown:**

  * `-u "http://localhost:8080/"`: Sets the target URL.
  * `--data="..."`: Specifies the POST data to send, mimicking a login attempt.
  * `-p password`: Tells sqlmap to test the `password` parameter for injection.
  * `--dbs --tables --columns --dump`: Instructs sqlmap to enumerate databases, tables, columns, and then dump all the data.
  * `--exclude-sysdbs`: Ignores system databases (like `information_schema`).
  * `--batch`: Runs the tool with default answers to all prompts (non-interactive).

-----

## 🧹 Resetting the Lab

If you need to reset the database or stop the lab:

  * **Stop and remove containers:**
    ```bash
    docker-compose down
    ```
  * **Restart the lab:**
    ```bash
    docker-compose up -d
    ```

-----

## ⚠️ Disclaimer

This project is for **educational purposes only**. Do not use these techniques on any system or application without explicit permission from the owner.
