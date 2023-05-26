(function()
{
    window.addEventListener('DOMContentLoaded', () =>
    {
        const inputs = document.querySelectorAll('.input-js');
        const button = document.querySelector('.button-change-user-js');

        if (button !== null)
        {
            button.addEventListener('click', (event) =>
            {
                console.log("OK");
                event.preventDefault();
                const block = document.querySelector('.data-block-js');

                if ((inputs[0].value.length > 0 || inputs[1].value.length > 0 || inputs[2].value.length > 0) && block !== null)
                {
                    const ip = block.dataset.ip;
                    const session_id = block.dataset.sess;

                    fetch(`${url_ajax_index}?name=${inputs[0].value}&password=${inputs[1].value}&email=${inputs[2].value}&ip=${ip}&session_id=${session_id}`)
                        .then(response => response.json())
                        .then(data =>
                        {
                            const blocks = document.querySelectorAll('.info-cabinet-js');
                            blocks[0].innerHTML = data.login;
                            blocks[1].innerHTML = data.name;
                            blocks[2].innerHTML = data.email;
                        })
                        .catch((error) => { console.error('Ошибка:', error); } );
                }
            });
        }

        const button_delete = document.querySelector('.button-delete-user-js');

        if (button_delete !== null)
        {
            button_delete.addEventListener('click', () =>
            {
                const block = document.querySelector('.data-block-js');
                const ip = block.dataset.ip;
                const session_id = block.dataset.sess;

                fetch(`${url_ajax_index}?action=delete&ip=${ip}&session_id=${session_id}`)
                    .then(response => response.json())
                    .then(data =>
                    {
                        if (data === "1")
                        {
                            location.reload();
                        }
                    })
                    .catch((error) => { console.error('Ошибка:', error); } );
            });
        }
    });
})();