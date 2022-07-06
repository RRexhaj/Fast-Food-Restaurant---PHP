// var x = document.getElementById('')

// var constraints = {
//   name: {
//     presence: true,
//     length: {
//       minimum: 1,
//       maximum: 15,
//       message: "Name must be between 1 and 15 characters"
//     }
//   },
//   surname: {
//     presence: true,
//     length: {
//       minimum: 1,
//       maximum: 15,
//       message: "Surname must be between 1 and 15 characters"
//     }
//   },
//   phone:{
//     presence: true,
//     format: {
//       pattern: /^\(?(\+[0-9]{1,3})[ ]\)?(\([0-9]{3}\))[ ]?([0-9]{3})[ ]?([0-9]{1,4})$/,
//       message: function(value, attribute, validatorOptions, attributes, globalOptions) {
//         return validate.format("^%{phone} is not a valid Phone Number", {
//           phone: value
//         });
//       }
//     }
//   },
//   email: {
//     presence: true,
//     email: true,
//   },
//   password: {
//     presence: true,
//     length: {
//       minimum: 3,
//       message: "must be at longer than 3 character"
//     }
//   },
// };


// validate({name: "nicklas", surname:"Asurname", email:"ecom", phone:"+1 (123) 123-4567", password: "swbd" }, constraints, {format: "detailed"});

// // isMobilePhone("+1 (123) 123-4567")

var validator = new FormValidator('example_form', [{
    name: 'req',
    display: 'required',
    rules: 'required'
}, {
    name: 'alphanumeric',
    rules: 'alpha_numeric'
}, {
    name: 'password',
    rules: 'required'
}, {
    name: 'password_confirm',
    display: 'password confirmation',
    rules: 'required|matches[password]'
}, {
    name: 'email',
    rules: 'valid_email',
    depends: function() {
        return Math.random() > .5;
    }
}, {
    name: 'minlength',
    display: 'min length',
    rules: 'min_length[8]'
}], function(errors, event) {
    if (errors.length > 0) {
        // Show the errors
    }
});