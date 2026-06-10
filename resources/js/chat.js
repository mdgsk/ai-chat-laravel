// console.log('chat.js loaded');

const form = document.getElementById('chat-form');
const submitBtn = document.getElementById('submit-btn');
const promptInput = document.getElementById('question');
const historyContainer = document.getElementById('chat-history-container');

let isProcessing = false;

// console.log(form);
console.log(historyContainer);

if (form) {

    form.addEventListener('submit', async function(event) {

        event.preventDefault();

        if (isProcessing) return;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Thinking...';
        isProcessing = true;

        try {

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

                tempCard.querySelector('.answer-content').innerHTML = data.html;
                tempCard.querySelector('.chat-meta').textContent = `${data.provider} | ${data.model}`;

                tempCard.querySelectorAll('pre code')
                .forEach((block) => {
                    hljs.highlightElement(block);
                });
            }

        } catch (error) {

            console.error(error);
            tempCard.querySelector('.answer-content').innerHTML = '<div class="text-danger">Something went wrong.</div>';
            tempCard.querySelector('.chat-meta').textContent = '';

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

}


function escapeHtml(text)
{
    const div = document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}


// function createChatCard(prompt, answer, meta)
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