(function() {
    window.demo = window.demo || {};

    demo.createInterface = function() {
            document.getElementById('content').innerHTML = "<h1>CSCI 3130 Demo App</h1>" +
                "<form>" +
                    "<select id='userlist' size=10>" +
                    "</select>" +
                    "<label for='name'>Name</label>" +
                    "<input type='text' id='name' />" +
                    "<label for='hometown'>Hometown</label>" +
                    "<input type='text' id='hometown' />" +
                    "<label for='occupation'>Occupation</label>" +
                    "<input type='text' id='occupation' />" +
                    "<button id='updateuser'>Update User</button>" +
                    "<button id='deleteuser'>Delete User</button>" +
                    "<button id='adduser'>Add User</button>" +
                "</form>";
        }
})()
