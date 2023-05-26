(function()
{
    window.addEventListener('DOMContentLoaded', () =>
    {
        const ajax = (url_ajax_auth, str_param) =>
        {
            fetch(`${url_ajax_auth}?${str_param}`)
                .then(response => response.json())
                .then(data =>
                {
                    if (data === "0")  // выводит форму регистрации
                    {
                        const block = document.querySelector('.form-error-text-js');

                        if (block !== null && block.classList.contains('display-none'))
                        {
                            block.classList.remove('display-none');
                        }
                    }
                    else               // вставляет в блок имя пользователя
                    {
                        const block = document.querySelector('.form-log-js');
                        const text = document.querySelector('.log-text-js');
                        const button_logout = document.querySelector('.button-logout-js');

                        if (block !== null && !block.classList.contains('display-none'))
                        {
                            block.classList.add('display-none');
                        }

                        if (text !== null && text.classList.contains('display-none'))
                        {
                            const text_name = text.querySelector('.log-name-js');
                            text_name.innerHTML = data;
                            text.classList.remove('display-none');
                        }

                        if (button_logout !== null)
                        {
                            location.reload();
                        }
                    }
                })
                .catch((error) => { console.error('Ошибка:', error); } );
        }

        const authorization = () =>
        {
            const button_logup = document.querySelector('.button-logup-js');

            if (button_logup != null)
            {
                const login = document.querySelector('.login-js');
                const password = document.querySelector('.password-js');

                button_logup.addEventListener('click', (event) =>
                {
                    event.preventDefault();
                    const str_login = login.value;
                    const str_pass = password.value;

                    const data_block = document.querySelector('.data-block-js');
                    const ip = data_block.dataset.ip;
                    const sess = data_block.dataset.sess;
                    const request = `authorization=logup&login=${str_login}&password=${str_pass}&ip=${ip}&sessid=${sess}`;
                    ajax(url_ajax_auth, request);
                });
            }
        }

        authorization();

        const closeSession = () =>
        {
            const button = document.querySelector('.button-logout-js');

            if (button !== null)
            {
                button.addEventListener('click', () =>
                {
                    const data_block = document.querySelector('.data-block-js');
                    const ip = data_block.dataset.ip;
                    const sess = data_block.dataset.sess;
                    const request = `authorization=logout&ip=${ip}&sessid=${sess}`;
                    ajax(url_ajax_auth, request);
                });
            }
        }

        closeSession();
    });
})();

