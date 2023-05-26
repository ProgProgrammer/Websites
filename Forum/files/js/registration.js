class Registration {
        #ajax(url_ajax_auth, str_param) {
            fetch(`${url_ajax_auth}?${str_param}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data === "0")  // выводит форму регистрации
                    {
                        const block = document.querySelector('.form-error-text-js');

                        if (block !== null && block.classList.contains('display-none')) {
                            block.classList.remove('display-none');
                        }
                    } else               // вставляет в блок имя пользователя
                    {
                        const block = document.querySelector('.form-log-js');
                        const text = document.querySelector('.log-text-js');
                        const button_reg = document.querySelector('.button-registr-js');

                        if (block !== null && !block.classList.contains('display-none')) {
                            block.classList.add('display-none');
                        }

                        if (text !== null && text.classList.contains('display-none')) {
                            const text_name = text.querySelector('.log-name-js');
                            text_name.innerHTML = data;
                            text.classList.remove('display-none');
                        }

                        if (button_reg !== null) {
                            location.reload();
                        }
                    }
                })
                .catch((error) => {
                    console.error('Ошибка:', error);
                });
        }

    #checkLogin(login)
    {
        fetch(`${url_ajax_auth}?login=${login}`)
            .then(response => response.json())
            .then(data =>
            {
                console.log(data);
                const block = document.querySelector('.form-error-text-js');

                if (data === "1") {
                    if (block !== null && !block.classList.contains('display-none'))
                    {
                        block.classList.add('display-none');
                    }

                    const password = document.querySelector('.password-js');
                    const name = document.querySelector('.name-js');
                    const email = document.querySelector('.email-js');
                    const str_pass = password.value;
                    const str_name = name.value;
                    const str_email = email.value;

                    const data_block = document.querySelector('.data-block-js');
                    const ip = data_block.dataset.ip;
                    const sess = data_block.dataset.sess;

                    const request = `login=${login}&password=${str_pass}&name=${str_name}&email=${str_email}&ip=${ip}&session_id=${sess}`;
                    this.#ajax(url_ajax_auth, request);
                }
                else
                {
                    if (block !== null && block.classList.contains('display-none'))
                    {
                        block.classList.remove('display-none');
                    }
                }
            })
            .catch((error) => {
                console.error('Ошибка:', error);
            });
    }

    #registration()
    {
        const button_reg = document.querySelector('.button-registr-js');

        if (button_reg != null) {
            const login = document.querySelector('.login-js');
            const password = document.querySelectorAll('.password-js');

            button_reg.addEventListener('click', (event) => {
                event.preventDefault();
                console.log(button_reg);
                const str_login = login.value;
                const str_pass = password[0].value;
                const str_pass_conf = password[1].value;

                const text_error = document.querySelectorAll('.form-error-text-js');

                if (str_pass === str_pass_conf) {
                    if (!text_error[1].classList.contains('display-none'))
                    {
                        text_error[1].classList.add('display-none');
                    }
                    console.log('OK');

                    this.#checkLogin(str_login);
                }
                else
                {
                    console.log('NO OK');
                    if (text_error[1].classList.contains('display-none'))
                    {
                        console.log('NO OK2');
                        text_error[1].classList.remove('display-none');
                    }
                }
            });
        }
    }

    startLoop()
    {
        this.#registration();
    }
}

(function()
{
    window.addEventListener('DOMContentLoaded', () =>
    {
        const registration = new Registration();
        registration.startLoop();
    });
})();

