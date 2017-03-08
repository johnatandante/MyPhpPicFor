    alert("script run");

    function FormViewModel(){
        this.firstName = "cicco";
        this.evaluateForm = function(){
            alert("Pressed evaluate");
        };
    }

    ko.applyBindings(new FormViewModel());
    alert("script runed");