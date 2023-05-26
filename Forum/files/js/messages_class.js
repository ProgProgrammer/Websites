const url_ajax = "backend/messages.php";
const get_mes = "all";

export class Messages
{
    #pageRequest()
    {
        const container_mes = document.querySelector('.container-message-js');

        if (container_mes != null)
        {
            fetch(`${url_ajax}?mes=${get_mes}`)
                .then(response => response.json())
                .then(data =>
                {
                    const block_mes = document.querySelector('.block-message-js');
                    const name_mes = block_mes.querySelector('.name-message-js');
                    const number_mes = block_mes.querySelector('.number-message-js');
                    const text_mes = block_mes.querySelector('.text-message-js');

                    for (const key in data)
                    {
                        name_mes.innerHTML = data[key].name;
                        number_mes.innerHTML = data[key].id;
                        text_mes.innerHTML = data[key].text;
                        let cloneBlock = block_mes.cloneNode(true);
                        container_mes.appendChild(cloneBlock);
                    }

                    const container_blocks_mes = container_mes.querySelectorAll('.block-message-js');
                    const dis_none_class = 'display-none';

                    for (let key = 0; key < container_blocks_mes.length; ++key)
                    {
                        if (container_blocks_mes[key].classList.contains(dis_none_class))
                        {
                            container_blocks_mes[key].classList.remove(dis_none_class);
                        }
                    }
                })
                .catch((error) => { console.error('Ошибка:', error); } );
        }
    }

    #authorization()
    {
        const button_logup = document.querySelector('.button-logup-js');
        const button_reg = document.querySelector('.button-registration-js');

        if (button_logup != null && button_reg != null)
        {
            const login = document.querySelector('.login-js');
            const password = document.querySelector('.password-js');
        }
    }

    startLoop()
    {
        this.#pageRequest();
    }
}