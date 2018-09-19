

document.addEventListener('DOMContentLoaded', () => { 

    document.querySelector('#registrationForm').addEventListener('submit', ajaxRegistration);

    function ajaxRegistration(event) {
        event.preventDefault();

        const data = {
            '_token': document.querySelector("input[name='_token']").value,
            'username': document.querySelector("input[name='username']").value,
            'name': document.querySelector("input[name='name']").value,
            'password': document.querySelector("input[name='password']").value,
            'password_confirmation': document.querySelector("input[name='password_confirmation']").value,
            'email': document.querySelector("input[name='email']").value
        };

        send(data);
    }

    function send(data) {
        fetch('/register', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': data._token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(result) {
            if(result.success === true) {
                displaySuccessMessage();
                redirect();
            }else {
                const errors = Object.entries(result);
                clearBoxes();
                displayErrors(errors);
                clearInputs(errors);
            }
                
        })
        .catch(function(error) {
            console.log(error);
        });
    }

    function clearBoxes() {
        if(document.querySelector('.error-box'))
            document.querySelector('.error-box').remove();

        if(document.querySelector('.success-box'))
            document.querySelector('.success-box').remove();
    }

    function clearInputs(errors) {
        for (let error of errors) {
            document.querySelector(`input[name='${error[0]}']`).value = '';
        }
    }

    function displayErrors(errors) {

        let errorListItems = '';

        for (let error of errors) {
            errorListItems += `<li> ${error[1][0]} </li>`;
        }

        let markup = `<div class="error-box">
                        <h2 class="error-message"> Registration failed </h2>
                        <ul>
                            ${errorListItems}
                        </ul>
                    </div>`;

        document.querySelector('.error').insertAdjacentHTML('afterbegin', markup);
    }

    function displaySuccessMessage() {
        let markup = `<div class="success-box">
                        <h2 class="error-message"> Registration succeeded </h2>
                        <p>You will be redirected in <span id="redirection-time"></span> seconds...</p>
                    </div>`;
        document.querySelector('.success').insertAdjacentHTML('afterbegin', markup);
    }

    function redirect() {

        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                console.log(i);
                 document.querySelector('#redirection-time').textContent = 5 - i;
                 if(i === 4)
                    window.location.href = '/';
            }, i * 1000);
        }
        
    }

}, false);