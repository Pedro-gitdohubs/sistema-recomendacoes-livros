// Funções JavaScript para o Sistema de Recomendações de Livros

// Confirmação para exclusão
function confirmarExclusao(nome, url) {
    if (confirm(`Tem certeza que deseja excluir "${nome}"? Esta ação não pode ser desfeita.`)) {
        window.location.href = url;
    }
}

// Validação de formulários
document.addEventListener('DOMContentLoaded', function() {
    // Validação de email
    const emailInputs = document.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                this.style.borderColor = '#e74c3c';
                showTooltip(this, 'Por favor, insira um email válido');
            } else {
                this.style.borderColor = '#ddd';
                hideTooltip(this);
            }
        });
    });
    
    // Validação de senha
    const senhaInputs = document.querySelectorAll('input[name="senha"]');
    senhaInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const senha = this.value;
            
            if (senha && senha.length < 6) {
                this.style.borderColor = '#e74c3c';
                showTooltip(this, 'A senha deve ter pelo menos 6 caracteres');
            } else {
                this.style.borderColor = '#ddd';
                hideTooltip(this);
            }
        });
    });
    
    // Validação de nota
    const notaInputs = document.querySelectorAll('input[name="nota"]');
    notaInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const nota = parseFloat(this.value);
            
            if (this.value && (isNaN(nota) || nota < 0 || nota > 5)) {
                this.style.borderColor = '#e74c3c';
                showTooltip(this, 'A nota deve estar entre 0 e 5');
            } else {
                this.style.borderColor = '#ddd';
                hideTooltip(this);
            }
        });
    });
    
    // Auto-hide alerts após 5 segundos
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
    
    // Busca em tempo real
    const searchInput = document.querySelector('input[name="termo"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    const form = this.closest('form');
                    if (form) {
                        form.submit();
                    }
                }
            }, 500);
        });
    }
});

// Função para mostrar tooltip
function showTooltip(element, message) {
    hideTooltip(element); // Remove tooltip existente
    
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = message;
    tooltip.style.cssText = `
        position: absolute;
        background: #e74c3c;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        z-index: 1000;
        margin-top: 5px;
    `;
    
    element.parentNode.style.position = 'relative';
    element.parentNode.appendChild(tooltip);
}

// Função para esconder tooltip
function hideTooltip(element) {
    const tooltip = element.parentNode.querySelector('.tooltip');
    if (tooltip) {
        tooltip.remove();
    }
}

// Função para formatar nota com estrelas
function formatarNota(nota) {
    const estrelas = Math.round(nota);
    return '⭐'.repeat(estrelas) + '☆'.repeat(5 - estrelas);
}

// Aplicar formatação de notas
document.addEventListener('DOMContentLoaded', function() {
    const notaElements = document.querySelectorAll('.nota');
    notaElements.forEach(element => {
        const nota = parseFloat(element.textContent);
        if (!isNaN(nota)) {
            element.title = `${nota}/5`;
        }
    });
});

// Função para copiar texto
function copiarTexto(texto) {
    navigator.clipboard.writeText(texto).then(() => {
        alert('Texto copiado para a área de transferência!');
    });
}

// Função para imprimir página
function imprimirPagina() {
    window.print();
}

// Função para voltar à página anterior
function voltarPagina() {
    history.back();
}

