# Time Sheet

## Instuctions
   1. CREATE a DATABASE in POSTGRESQL.
      * ``` 
         CREATE DATABASE <database name> ;

       ```
   2. CREATE USER <username> WITH PASSWORD <password>
      * ```
         CREATE USER <username> WITH PASSWORD <password> ;

        ```


   3. CREATE a TABLE with COLUMNS
      * ```
         CREATE TABLE <table name> (
            id int NOT NULL,
            task\_name varchar(50) NOT NULL,
            clock\_in\_time NOW(),
            clock\_out\_time ,
            task\_date CURRENT\_DATE,
         );

      ```


   instructions in progress...   