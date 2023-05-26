//import * as mes from './messages_class.js';

class Messages
{
    #byField(field)
    {
        return (a, b) => a[field] > b[field] ? 1 : -1;
    }

    #pageRequest(get_mes)
    {
        const container_mes = document.querySelector('.container-message-js');

        if (container_mes != null)
        {
            fetch(`${url_ajax_index}?num_mes=${get_mes}`)
                .then(response => response.json())
                .then(data =>
                {
                    const block_mes = document.querySelector('.block-message-js');
                    const name_mes = block_mes.querySelector('.name-message-js');
                    const number_mes = block_mes.querySelector('.number-message-js');
                    const text_mes = block_mes.querySelector('.text-message-js');

                    for (const key in data)
                    {
                        data[key].id = Number(data[key].id);
                    }

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

    #getMessages()
    {
        const container_mes = document.querySelector('.container-message-js');
        const button = document.querySelector('.more-messages-js');

        button.addEventListener('click', () =>
        {
            const block_mes = container_mes.querySelectorAll('.number-message-js');
            this.#pageRequest(block_mes[block_mes.length - 1].textContent);
        });
    }

    #setMessages(text)
    {
        if (text.length > 0)
        {
            const data_block = document.querySelector('.data-block-js');
            const ip = data_block.dataset.ip;
            const sess = data_block.dataset.sess;

            fetch(`${url_ajax_index}?text=${text}&ip=${ip}&sess_id=${sess}`)
                .then(response => response.json())
                .then(data =>
                {
                    if (data = "1")
                    {
                        const container_mes = document.querySelector('.container-message-js');
                        const block_mes = container_mes.querySelectorAll('.number-message-js');
                        this.#pageRequest(block_mes[block_mes.length - 1].textContent);
                    }
                    this.#getMessages();
                })
                .catch((error) => { console.error('Ошибка:', error); } );
        }
    }

    #sendMessages()
    {
        const button = document.querySelector('.mes-button-js');
        const text_block = document.querySelector('.form-messages-text-js');

        if (button !== null)
        {
            button.addEventListener('click', () =>
            {
                this.#setMessages(text_block.value);
            });
        }
    }

    startLoop()
    {
        this.#pageRequest("0");
        this.#getMessages();
        this.#sendMessages();
    }
}

(function()
{
    window.addEventListener('DOMContentLoaded', () =>
    {
        const messages = new Messages();
        messages.startLoop();
    });
})
();