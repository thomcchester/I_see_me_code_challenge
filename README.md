1. I would like to start by saying that I have never actually used symfony, so this is all new to me, so I apologize if I break any standard syntax or rules in this. 

    I know that it was stated that just a bash script was needed, for the first part, but that seemed to me like it would be not as useful if not in the right context. That being said I decided to create a symfony app that I could use to show and answer the coding challenge. 

    Steps used to create:
    1. First used homebrew to load MySQL as it is was not something I had set up.   

    2. For the purposes of this challenge I felt that testing on an insecure passwordless database would suffice, as such I decided that just using root would be fine. 

    3. created iseeme database on mysql

    4. I am very well aware that there appears to be a lot of automagical operations and helpers going in php/symfony. I also expect that much of the camelcase/plurality/underscore syntax is likely to be very different than that of RoR. Furthermore, "order" is a special sql word. For this reason **I am going to call them all BookOrder/book_order/book_orders/BookOrders** etc rather than just order to prevent that particular issue from occurring. I apologize if this creates conflict. 

    5. Using `php bin/console make:entity` I created the BookOrder entity.

    6. For simplicity of this particular example I am only adding the `order_status`, `customer_service_note` and `id`(well already comes) as columns to this table. 

    7. created the migration with `php bin/console make:migration`

    8. ran migration with `php bin/console doctrine:migrations:migrate`
    can see: 
    mysql> describe book_order;
    +-----------------------+--------------+------+-----+---------+----------------+
    | Field                 | Type         | Null | Key | Default | Extra          |
    +-----------------------+--------------+------+-----+---------+----------------+
    | id                    | int(11)      | NO   | PRI | NULL    | auto_increment |
    | order_status          | varchar(255) | YES  |     | NULL    |                |
    | customer_service_note | longtext     | YES  |     | NULL    |                |
    +-----------------------+--------------+------+-----+---------+----------------+

    9. Now at this point I have could have created sql queries to create a bunch of instances that I am going test future written script on, however I thought it would be a better learning tool to go ahead and make a controller that would create instances and store them(at the point of writing this I am not sure if I am going to make it singular/multiple/static/dynamic)

    10. First I am running `php bin/console make:controller BookOrderController`

    11. Okay so first thing I did there was a create the controller with route and function that creates entities with null fields for order status and customer_service_note. By just visiting the url: `https://127.0.0.1:8000/book_order_null_order_status_null_customer_service_note` 

    12. I then did the same thing for error:null, error:some other text, error:connection failed. I just created a few and they are very verbose names that I would not keep indefinitely but just wanted to be very clear at the moment. I would eventually turn those to take in parameters and stop the duplication, but for times sake, and since the creation of rows was not really part of the problem I will leave them for now. They can be seen in `src/Controller/BookOrderController.php`

    13. Okay I got something like this by just visting those urls:
    mysql> SELECT * FROM book_order;
    +----+--------------+----------------------------+
    | id | order_status | customer_service_note      |
    +----+--------------+----------------------------+
    |  1 | NULL         | NULL                       |
    |  2 | NULL         | NULL                       |
    |  3 | NULL         | NULL                       |
    |  4 | NULL         | NULL                       |
    |  5 | NULL         | NULL                       |
    |  6 | NULL         | NULL                       |
    |  7 | NULL         | NULL                       |
    |  8 | error        | NULL                       |
    |  9 | error        | NULL                       |
    | 10 | error        | NULL                       |
    | 11 | error        | NULL                       |
    | 12 | error        | some other text is in here |
    | 13 | error        | some other text is in here |
    | 14 | error        | some other text is in here |
    | 15 | error        | some other text is in here |
    | 16 | error        | some other text is in here |
    | 17 | error        | connection failed          |
    | 18 | error        | connection failed          |
    | 19 | error        | connection failed          |
    | 20 | error        | connection failed          |
    | 21 | error        | connection failed          |
    +----+--------------+----------------------------+
    21 rows in set (0.00 sec)

    14. Now I will actually create script asked for in this code challenge. Now it seems that symfony creates a really compact and simple way of doing this. I am assuming that although the challenge says bash-fu, what is more important is it just running out of the box when ran in a shell. 

    15. To start I am just figuring this stuff out so I am making a quick `hello world` to make sure I understand how it works (or if it does!).

    16. Okay I have a simple hello world running, it is in the `iseeme/src/Command/DoingStuffCommand.php` file and just requires running `php bin/console hello-world`. I have yet to figure out how to make this part of the actual symfony command, however, for timesake I am going to get the logic working first and then circle back to that when I get the chance. 

    17. I have decided that it would make more sense for this be a little bit modular and broken up into the mvc, I am not sure if this is what is wanted but felt that it made the most sense. For that reason what I have done is put:
        `getOrderStatusOfFailureBoolean`
        `getHasConnectionFailedInServiceNote`
        `getMeetsOrderApproveCriteria`
    as methods on the entity of BookOrder. These can be found in `iseeme/src/Entity/BookOrder.php`

    18. Now in ruby I would create a service class to run the checks and call the change value, then put the service class in the script. However, I do not really know how the service class system is suppose to work in php/symfony, so I did something that might be considered a terrible idea, and that is that I put the call in the controller `iseeme/src/Controller/BookOrderController.php`

    19. I suppose it would make sense for me to commit my code. 

    20. 










Question 5.
 I am not completely sure which methods are being referred to here, but I think the question is referring to `chaining`, `pyramid chaining`, `reverse pryamid chaining`, and `nesting` and various combinations of these techniques. I guess if were to name the one that is most commonly used it would be chaining. Chaining is the approach of only moving on to the next promise upon completion of the previous promise. Chain promises are only executed upon the completion of the previous promise and are mainly denoted in the `.then()` syntax. 

 This is probably best explained through a little code snippet and explaination.
 The basic idea is that:

 |---------------------| 
 | new promise created |
 |---------------------|
        |
        V
resolving_promise
        |
        V
 |---------------------| 
 | new promise called  |
 |---------------------|
        |
        V
    resolve_promise
        |
        V
 |---------------------| 
 | new promise created |
 |---------------------|
 
 Say that you wanted to have geometric backoff on running some line of code (maybe for computational purposes, maybe because you are getting rate limited, maybe because you are trying to disuade user from repeat action)
 ```javascript
    new Promise(function(resolve, reject) {

    run_function_that_is_to_be_backoffed()
    setTimeout(() => resolve(1), 1000);

    }).then(function(result) {
    
    run_function_that_is_to_be_backoffed()

    return new Promise((resolve, reject) => { // (*)
        setTimeout(() => resolve(result * 2), 1000);
    });

    }).then(function(result) { // (**)

    run_function_that_is_to_be_backoffed()

    return new Promise((resolve, reject) => {
        setTimeout(() => resolve(result * 2), 1000);
    });

    }).then(function(result) {
    
    run_function_that_is_to_be_backoffed()

});
 ```
 Now this example is non-dynamic and only runs for the instant case, 1 second later, 2 seconds later, 4 seconds later, in reality this particular example should be recursive with a shutoff or pull back (recurrisive promises can lead to infinite loops if you are not careful.)

 I wont go as indepth on creating explainations for the others, but the ideas are somewhat similiar. `nesting` is like chaining but instead of calling a promise upon resolution you are putting a new promise inside of the parent promise, this can be done indefinetly and can create some serious hell in your code if you are not careful. 

 `pyramid chaining` is the approach of creating a promise that triggers multiple new promises simultaneously creating a 1:n relationship. The classic example is a three relationship (because it looks most like a pyramid to our minds), where one promise triggers 3 new promises and those trigger 3 new promises, and boom a pyramid schema(heehee). 

 `reverse pyramid chaining` is not common at all is not recommended execept for very specific purposes and the explaination of getting one set up is super annoying. The essence is that you nest n promises in a parent promise that only triggers a new promise upon completion of all child promises, thus in essence you could have the completion of 3 promises trigger a new promise. 

 Now I am not really sure if there are countably/uncountably infinite ways to combine these, but it there are for sure an infinite number of ways of setting up combination of these promises if you allow for n->inf promises. 


 6. I will do what I did similar to the first question and give a storry of how I   am doing things. 
    1. First things first. Download go. 
    2. Create application. 
    3. Make it print `hello world` in terminal
    4. create pdf. 
    5. make it put `hello world` in pdf
        a. `go get` in https://github.com/jung-kurt/gofpdf as an open source project
        b. load it into hello world file
    6. Make more coffee
    7. Figure out how to resize this thing. 
        a. It appears that 96 pixels per inch is standard, so I set it to create a file that is 480 x 480 
        b. put wording in. 
    8. make containted script
    9. In the diretory calledc `go` there should be multiple files. The `hello.go` file is the script, and `hello` should just be a command that if loaded in usr/local/bin and chmoded then it should run, otherwise the whole go directory needs to be set to the go home path in ./bash_profile and you can then either run `go hello.go` or `go build hello.go` then just run `hello`

    I did not really run into any difficulties here making this little program, it was pretty self explainatory. 
