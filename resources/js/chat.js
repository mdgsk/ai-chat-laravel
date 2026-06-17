// console.log('chat.js loaded');

const form = document.getElementById('chat-form');
const submitBtn = document.getElementById('submit-btn');
const promptInput = document.getElementById('question');
const historyContainer = document.getElementById('chat-history-container');
const noHistoryMessage = document.getElementById('no-history-message');
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

let isProcessing = false;

// console.log(form);
// console.log(historyContainer);

if (form) {

    form.addEventListener('submit', async function(event) {

        event.preventDefault();

        if (isProcessing) return;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Thinking...';
        isProcessing = true;

        const promptText = promptInput.value;
        const tempId = 'temp-' + Date.now();
        historyContainer.insertAdjacentHTML(
            'afterbegin',
            createChatCard(
                promptText,
                '<em>Thinking...</em>',
                '',
                tempId
            )
        );
        const tempCard = document.getElementById(tempId);

        try {

            const response = await fetch(
                '/ajax-chat',
                {
                    method: 'POST',
                    body: new FormData(form)
                }
            );
            const data = await response.json();

            console.log(data);
            
            if (data.success) {

                promptInput.value = '';
                promptInput.focus();
                historyContainer.scrollTop = 0;

                if (noHistoryMessage) {
                    noHistoryMessage.remove();
                }

                tempCard.querySelector('.answer-content').innerHTML = data.html;
                tempCard.querySelector('.chat-meta').textContent = `${data.provider} | ${data.model} | ${data.timestamp}`;

                tempCard.querySelectorAll('pre code')
                .forEach((block) => {
                    hljs.highlightElement(block);
                });

            } else {

                console.error('!data.success : '+data.message);

                tempCard.querySelector('.answer-content').innerHTML =
                    `<div class="error-message">${data.message}</div>`;

                tempCard.querySelector('.chat-meta').textContent = '';

            }

        } catch (error) {

            console.log('catch : '+error);

            if (tempCard) {
                // tempCard.querySelector('.answer-content').innerHTML = '<div class="error-message">Something went wrong..!</div>';
                tempCard.querySelector('.answer-content').innerHTML = `<div class="error-message">${error.message}</div>`;
                tempCard.querySelector('.chat-meta').textContent = '';
            }

        } finally {

            isProcessing = false;
            submitBtn.disabled = false;
            submitBtn.textContent = 'Ask AI';  

        }

    });

    promptInput.addEventListener('keydown', function(event) {
        if (
            event.key === 'Enter' &&
            !event.shiftKey
        ) {

            event.preventDefault();

            form.requestSubmit();

        }
    });


    document.querySelectorAll('.edit-btn').forEach(btn => {

        btn.addEventListener('click', async (e) => {

            e.preventDefault();
            e.stopPropagation();

            const title = prompt('Enter new title');

            if (!title) return;

            const id = btn.dataset.id;

            const response = await fetch(
                `/conversations/${id}/rename`,
                {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        title
                    })
                }
            );

            const data = await response.json();

            if (data.success) {
                location.reload();
            }

        });

    });


    document.querySelectorAll('.delete-btn').forEach(btn => {

        btn.addEventListener('click', async (e) => {

            e.preventDefault();
            e.stopPropagation();

            if (!confirm('Delete this conversation?')) {
                return;
            }

            const id = btn.dataset.id;

            const response = await fetch(
                `/conversations/${id}`,
                {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            );

            if (response.ok) {
                location.href = '/';
            }

        });

    });

}


function escapeHtml(text)
{
    const div = document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}


function createChatCard(prompt, answer, meta, cardId = '')
{
    return `
        <div class="chat-pair" id="${cardId}">

            <div class="message-row user-message">
                <div class="message-bubble">
                    ${escapeHtml(prompt)}
                </div>
            </div>

            <div class="message-row assistant-message">
                <div class="message-bubble">

                    <div class="answer-content">
                        ${answer}
                    </div>

                    <div class="chat-meta">
                        ${meta}
                    </div>

                </div>
            </div>

        </div>
    `;
}