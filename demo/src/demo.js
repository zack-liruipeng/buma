/**
 * The main module
 * @module main
 */

/**
 * The wrapper function for the client's app code
 * @class clientapp
 */
(function() {
    var maxID = 0,
        /**
         * Updates the list of users based on the response from the server.  Calls updateForm() on completion.
         *
         * Called on page load and on changes to the user list.
         *
         * @event updateList
         */
            updateList = function() {
            var xhr = new XMLHttpRequest();
            //Might also use onreadystatechange
            xhr.onload = function() {

                var users = JSON.parse(xhr.responseText),
                    userIndex,
                    optionString = "";
                //Generate option elements based on the list of users received from the server
                for(userIndex = 0; userIndex < users.length; userIndex += 1) {
                    optionString += "<option value='" + users[userIndex].id + "'>" + users[userIndex].name +"</option>";
                    if(parseInt(users[userIndex].id,10) > maxID){
                        maxID = parseInt(users[userIndex].id, 10);
                    }
                }

                //Update the list element with the new users and move the selection to the end
                document.getElementById('userlist').innerHTML = optionString;
                document.getElementById('userlist').selectedIndex = userIndex-1;

                //Update the form with the newly selected user's information
                updateForm();


            };
            xhr.onerror = function(err) {
                console.log(err);
            };
            xhr.open('get', 'http://centi.cs.dal.ca:8000/user');
            xhr.send();

        },
        /**
         * Gets information about the currently selected user from the server and populates the form with it.
         *
         * Called when the the list is loaded or a user clicks on an item in the list.
         *
         * @event updateForm
         */
            updateForm = function() {
            var id = document.getElementById('userlist').value;
            var xhr = new XMLHttpRequest();
            if(parseInt(id, 10) > 0) {
                xhr.onload = function() {

                    var user = JSON.parse(xhr.responseText);


                    document.getElementById('name').value = user.name;
                    document.getElementById('occupation').value = user.occupation;
                    document.getElementById('hometown').value = user.hometown;


                };
                xhr.onerror = function(err) {
                    console.log(err);
                };
                xhr.open('get', 'http://centi.cs.dal.ca:8000/user/' + id);
                xhr.send();
            }
        },

        /**
         * Creates a user with default values and saves it to the server.
         *
         * Calls updateList() on completion
         *
         * @event createUser
         */
            createUser = function() {
            var id = maxID + 1,
                xhr = new XMLHttpRequest(),
                queryString = "?";
            maxID = id;

            //Express has some difficulties with JSON based data submission, so we're sending this with query parameters
            queryString += "id=" + id;
            queryString += "&name=" + "User" + id;
            queryString += "&occupation=";
            queryString += "&hometown=Halifax";

            xhr.onload = function() {
                updateList();
            };
            xhr.open("PUT", "http://centi.cs.dal.ca:8000/user" + queryString);
            xhr.send();

        },

        /**
         * Updates the information about a user based on what's been entered into the form.
         *
         * Calls updateList() on completion
         *
         * @event updateUser
         */
            updateUser = function() {
            var xhr = new XMLHttpRequest(),
                queryString = "?",
                id = document.getElementById('userlist').value;
            queryString += "&name=" + encodeURIComponent(document.getElementById('name').value);
            queryString += "&occupation=" + encodeURIComponent(document.getElementById('occupation').value);
            queryString += "&hometown=" + encodeURIComponent(document.getElementById('hometown').value);
            xhr.onload = function() {
                updateList();
            };
            xhr.open("POST", "http://centi.cs.dal.ca:8000/user/" + id + "?" + queryString);
            xhr.send();

        },

        /**
         * Removes a user from the list of users.
         *
         * Calls updateList() on completion
         *
         * @event deleteUser
         */
            deleteUser = function() {
            var xhr = new XMLHttpRequest(),
                id = document.getElementById('userlist').value;
            xhr.onload = function() {
                updateList();
            };
            xhr.open("DELETE", "http://centi.cs.dal.ca:8000/user/" + id);
            xhr.send()
        };


    window.demo = window.demo || {};
    /**
     * Initialize the application
     *
     * @event initApp
     */
    window.demo.initApp = function() {
        updateList();
        document.getElementById('userlist').addEventListener('click', updateForm);
        document.getElementById('adduser').addEventListener('click', function(e) {
            createUser();
            e.preventDefault();
            e.stopPropagation();
        });
        document.getElementById('updateuser').addEventListener('click', function(e) {
            updateUser();
            e.preventDefault();
            e.stopImmediatePropagation();
        });

        document.getElementById('deleteuser').addEventListener('click', function(e) {
            deleteUser();
            e.preventDefault();
            e.stopImmediatePropagation();
        });
    };
})()

