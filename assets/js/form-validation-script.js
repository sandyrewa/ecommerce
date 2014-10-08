var Script = function () {
    // base url
    var baseUrl = $("#base-url").val();
    $.validator.setDefaults({
        submitHandler: function(form) {
            //alert("submitted!");
            form.submit();
        }
    });

    $().ready(function() {
        // validate the add category form when it is submitted
        $("#addCategory").validate({
            rules: {
                category: {
                    required: true,
                    minlength: 3,
                    remote: {
                        url: baseUrl+"admin/check_cat_name",
                        type: "POST",
                        data: {
                            cat_id: function(){
                                return $('#cat_id').val();
                            }
                        }
                    }
                }
            },
            messages:{
                category: {
                    required: "Please provide a category name",
                    minlength: "Category name minimum 3 characters long",
                    remote: "Category name already exists please enter another category"
                }
            }
        });
        // validate the add product form on keyup and submit
        $("#addProduct").validate({
            rules:{
                category: "required",
                product: {
                    required: true,
                    minlength:4,
                    remote: {
                        url: baseUrl+"admin/check_product_unique",
                        type: "POST",
                        data: {
                            pname: function(){
                                return $('#pname').val();
                            }
                        }
                    }
                },
                product_price: "required",
                product_stock: "required"
            },
            messages:{
                category: "Please select a category for this product,",
                product: {
                    required: "Please provide a product name.",
                    minlength: "Product name minimum 4 characters long.",
                    remote: "Product already exists please enter another product detail."
                },
                product_price: "Please provide a product price.",
                product_stock: "Please provide stock quantity."
            }
        });
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();