describe("Demo App", function() {

    var xhr,
        requests;

    beforeEach(function () {

        //Create a mock HTTP server so we can run this without a real server
        xhr = sinon.useFakeXMLHttpRequest();

        //Store all requests made during a test
        requests = [];

        //Update the requests variable every time a new request is made
        xhr.onCreate = function (req) {
            requests.push(req);
        };

        //Before each test, re-create the interface to keep a clean slate
        demo.createInterface();

        //Attach event listeners to the interface
        demo.initApp();

        //Respond to the request that initApp() will have made for a list of users
        requests[0].respond(200, { "Content-Type": "application/json" },
            JSON.stringify([{"id":"1","name":"John MacDonald","hometown":"Halifax","occupation":"Farmer"},
                {"hometown":"BC","id":"2","name":"Daniel","occupation":"TA"},
                {"hometown":"Wisconsin","id":"3","name":"BillyBob","occupation":"Accountant"}]));

        //Respond to the request that initApp() will have made for user detail
        requests[1].respond(200, { "Content-Type": "application/json" },
            JSON.stringify({"hometown":"Wisconsin","id":"3","name":"BillyBob","occupation":"Accountant"}));
    });

    afterEach(function () {
        xhr.restore();
    });

    it("displays a list of users", function() {
        var userElements = document.getElementById('userlist').childNodes;

        //We should have two requests: the list and detail on a particular user
        expect(requests.length).toBe(2);

        //Make sure that the requests are to the right URLs
        expect(requests[0].url).toBe("http://centi.cs.dal.ca:8000/user");
        expect(requests[0].method).toBe("get");
        expect(requests[1].url).toBe("http://centi.cs.dal.ca:8000/user/3");
        expect(requests[1].method).toBe("get");

        //Verify that there are three items in the list
        expect(userElements.length).toBe(3);

        //Make sure the list elements are what we expect them to be
        expect(userElements[0].textContent).toBe("John MacDonald");
        expect(userElements[1].textContent).toBe("Daniel");
        expect(userElements[2].textContent).toBe("BillyBob");
    });

    it("creates a user", function() {
        //Click the add user button
        document.getElementById('adduser').click();

        //We should now have the initial two requests, plus another for creating the user
        expect(requests.length).toBe(3);

        //Make sure that the requests are to the right URLs
        expect(requests[2].url).toBe("http://centi.cs.dal.ca:8000/user?id=4&name=User4&occupation=&hometown=Halifax");
        expect(requests[2].method).toBe("PUT");

        //Mimic the response to the creation request
        requests[2].respond(200, { "Content-Type": "application/json" },
            "INSERTED");

        //Now we should have another request for the list of users
        expect(requests.length).toBe(4);
        requests[3].respond(200, { "Content-Type": "application/json" },
            JSON.stringify([{"id":"1","name":"John MacDonald","hometown":"Halifax","occupation":"Farmer"},
                {"hometown":"BC","id":"2","name":"Daniel","occupation":"TA"},
                {"hometown":"Wisconsin","id":"3","name":"BillyBob","occupation":"Accountant"},
                {"hometown":"Halifax","id":"4","name":"User4","occupation":""}]));

        //Now another request for the most recently created user
        expect(requests.length).toBe(5);
        requests[4].respond(200, { "Content-Type": "application/json" },
            JSON.stringify({"hometown":"Halifax","id":"4","name":"User4","occupation":""}));

        //Make sure that the requests are to the right URLs
        expect(requests[3].url).toBe("http://centi.cs.dal.ca:8000/user");
        expect(requests[3].method).toBe("get");
        expect(requests[4].url).toBe("http://centi.cs.dal.ca:8000/user/4");
        expect(requests[4].method).toBe("get");
        expect(document.getElementById('name').value).toBe("User4");
        expect(document.getElementById('occupation').value).toBe("");
        expect(document.getElementById('hometown').value).toBe("Halifax");
    });

    it("updates a user", function() {

        //Change the form values for the currently selected user (BillyBob)
        document.getElementById('name').value = "JimBob";
        document.getElementById('occupation').value = "Agricultural Engineer";
        document.getElementById('hometown').value = "Truro";

        //Click the update user button
        document.getElementById('updateuser').click();

        expect(requests.length).toBe(3);

        //Make sure that the requests are to the right URLs
        expect(requests[2].url).toBe("http://centi.cs.dal.ca:8000/user/3??&name=JimBob&occupation=Agricultural%20Engineer&hometown=Truro");
        expect(requests[2].method).toBe("POST");

        //Respond to the request for updating the user
        requests[2].respond(200, { "Content-Type": "application/json" },
            "UPDATED");
        expect(requests.length).toBe(4);

        //Respond to the request for an updated list of users
        requests[3].respond(200, { "Content-Type": "application/json" },
            JSON.stringify([{"id":"1","name":"John MacDonald","hometown":"Halifax","occupation":"Farmer"},
                {"hometown":"BC","id":"2","name":"Daniel","occupation":"TA"},
                {"hometown":"Truro","id":"3","name":"JimBob","occupation":"Agricultural Engineer"}]));
        expect(requests.length).toBe(5);

        //Make sure that the requests are to the right URLs
        expect(requests[3].url).toBe("http://centi.cs.dal.ca:8000/user");
        expect(requests[3].method).toBe("get");
        expect(requests[4].url).toBe("http://centi.cs.dal.ca:8000/user/3");
        expect(requests[4].method).toBe("get");

        //Respond to the request for detail on the recently updated user
        requests[4].respond(200, { "Content-Type": "application/json" },
            JSON.stringify({"hometown":"Truro","id":"3","name":"JimBob","occupation":"Agricultural Engineer"}));
    });
    it("deletes a user", function() {

        //Click the update user button
        document.getElementById('deleteuser').click();

        expect(requests.length).toBe(3);

        //Make sure that the requests are to the right URLs
        expect(requests[2].url).toBe("http://centi.cs.dal.ca:8000/user/3");
        expect(requests[2].method).toBe("DELETE");

        //Respond to the request for updating the user
        requests[2].respond(200, { "Content-Type": "application/json" },
            "DELETED");
        expect(requests.length).toBe(4);

        //Respond to the request for an updated list of users
        requests[3].respond(200, { "Content-Type": "application/json" },
            JSON.stringify([{"id":"1","name":"John MacDonald","hometown":"Halifax","occupation":"Farmer"},
                {"hometown":"BC","id":"2","name":"Daniel","occupation":"TA"}]));
        expect(requests.length).toBe(5);

        //Respond to the request for detail on the recently updated user
        requests[4].respond(200, { "Content-Type": "application/json" },
            JSON.stringify({"hometown":"BC","id":"2","name":"Daniel","occupation":"TA"}));

        //Make sure that the requests are to the right URLs
        expect(requests[3].url).toBe("http://centi.cs.dal.ca:8000/user");
        expect(requests[3].method).toBe("get");
        expect(requests[4].url).toBe("http://centi.cs.dal.ca:8000/user/2");
        expect(requests[4].method).toBe("get");
    });

});
