// ===== GAMING BLOG - EFECTOS JAVASCRIPT =====

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== 1. EFECTO TYPING EN EL LOGO =====
    function typingEffect() {
        const logoText = document.querySelector('#logo a');
        if (!logoText) return;
        
        const originalText = logoText.textContent;
        logoText.textContent = '';
        
        let i = 0;
        const typingInterval = setInterval(() => {
            logoText.textContent = originalText.slice(0, i + 1) + '|';
            i++;
            
            if (i >= originalText.length) {
                clearInterval(typingInterval);
                setTimeout(() => {
                    logoText.textContent = originalText;
                }, 500);
            }
        }, 100);
    }
    
    // Ejecutar efecto typing al cargar
    setTimeout(typingEffect, 500);
    
    // ===== 2. NAVEGACIÓN CON EFECTOS GAMING =====
    function setupNavEffects() {
        const menuLinks = document.querySelectorAll('#menu ul li a');
        
        menuLinks.forEach(link => {
            // Efecto ripple al hacer click
            link.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = 60;
                const x = e.clientX - rect.left - size/2;
                const y = e.clientY - rect.top - size/2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: radial-gradient(circle, rgba(99,102,241,0.6) 0%, transparent 70%);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
            
            // Efecto glitch aleatorio
            link.addEventListener('mouseenter', function() {
                if (Math.random() > 0.7) { // 30% probabilidad
                    this.style.animation = 'glitch 0.3s ease-in-out';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 300);
                }
            });
        });
    }
    
    // ===== 3. PARTÍCULAS FLOTANTES EN EL FONDO =====
    function createParticles() {
        const particlesContainer = document.createElement('div');
        particlesContainer.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        `;
        document.body.appendChild(particlesContainer);
        
        function createParticle() {
            const particle = document.createElement('div');
            const size = Math.random() * 4 + 1;
            const duration = Math.random() * 3000 + 2000;
            const opacity = Math.random() * 0.5 + 0.1;
            
            particle.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                background: radial-gradient(circle, #6366f1 0%, #8b5cf6 50%, #06b6d4 100%);
                border-radius: 50%;
                opacity: ${opacity};
                left: ${Math.random() * 100}vw;
                top: 100vh;
                animation: floatUp ${duration}ms linear infinite;
                box-shadow: 0 0 ${size * 2}px rgba(99,102,241,0.5);
            `;
            
            particlesContainer.appendChild(particle);
            
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, duration);
        }
        
        // Crear partículas cada cierto tiempo
        setInterval(createParticle, 300);
    }
    
    // ===== 4. EFECTOS EN LOS BLOQUES DEL SIDEBAR =====
    function setupSidebarEffects() {
        const bloques = document.querySelectorAll('.bloque');
        
        bloques.forEach((bloque, index) => {
            // Animación de entrada escalonada
            bloque.style.opacity = '0';
            bloque.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                bloque.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                bloque.style.opacity = '1';
                bloque.style.transform = 'translateY(0)';
            }, 200 * (index + 1));
            
            // Efecto gaming al hacer hover
            bloque.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.boxShadow = '0 20px 40px rgba(99,102,241,0.3)';
            });
            
            bloque.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '';
            });
        });
    }
    
    // ===== 5. EFECTO MATRIX EN INPUTS =====
    function setupInputEffects() {
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.boxShadow = '0 0 20px rgba(99,102,241,0.4), inset 0 0 20px rgba(99,102,241,0.1)';
                this.style.background = 'linear-gradient(135deg, #ffffff 0%, #f8fafc 100%)';
            });
            
            input.addEventListener('blur', function() {
                this.style.boxShadow = '';
                this.style.background = '';
            });
            
            // Efecto typing gaming
            input.addEventListener('input', function() {
                this.style.animation = 'pulse 0.1s ease-in-out';
                setTimeout(() => {
                    this.style.animation = '';
                }, 100);
            });
        });
    }
    
    // ===== 6. BOTONES CON EFECTOS GAMING =====
    function setupButtonEffects() {
        const botones = document.querySelectorAll('.boton, input[type="submit"], input[type="button"], #ver-todas a');
        
        botones.forEach(boton => {
            // Efecto de carga al hacer click
            boton.addEventListener('click', function(e) {
                const originalText = this.textContent || this.value;
                const isInput = this.tagName === 'INPUT';
                
                // Crear efecto de carga
                if (isInput) {
                    this.value = 'Procesando...';
                } else {
                    this.textContent = 'Procesando...';
                }
                
                this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                this.disabled = true;
                
                // Simular procesamiento
                setTimeout(() => {
                    if (isInput) {
                        this.value = originalText;
                    } else {
                        this.textContent = originalText;
                    }
                    this.style.background = '';
                    this.disabled = false;
                }, 1000);
            });
            
            // Efecto de energía al hover
            boton.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 0 30px rgba(99,102,241,0.6), 0 0 60px rgba(99,102,241,0.4)';
            });
            
            boton.addEventListener('mouseleave', function() {
                this.style.boxShadow = '';
            });
        });
    }
    
    // ===== 7. SCROLL GAMING EFFECTS =====
    function setupScrollEffects() {
        let ticking = false;
        
        function updateScrollEffects() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            // Parallax en el header
            const header = document.querySelector('#cabecera');
            if (header) {
                header.style.transform = `translateY(${rate}px)`;
            }
            
            // Efecto en el menú
            const menu = document.querySelector('#menu');
            if (menu && scrolled > 100) {
                menu.style.background = 'rgba(255,255,255,0.95)';
                menu.style.backdropFilter = 'blur(15px)';
                menu.style.transform = 'scale(0.95)';
            } else if (menu) {
                menu.style.background = '';
                menu.style.backdropFilter = '';
                menu.style.transform = '';
            }
            
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        });
    }
    
    // ===== 8. CURSOR GAMING PERSONALIZADO =====
    function setupGamingCursor() {
        const cursor = document.createElement('div');
        cursor.style.cssText = `
            position: fixed;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, #6366f1 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: all 0.1s ease;
            opacity: 0;
        `;
        document.body.appendChild(cursor);
        
        let mouseX = 0, mouseY = 0;
        
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.opacity = '0.6';
            cursor.style.left = mouseX - 10 + 'px';
            cursor.style.top = mouseY - 10 + 'px';
        });
        
        // Efectos especiales en elementos interactivos
        const interactiveElements = document.querySelectorAll('a, button, input, .boton');
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(2)';
                cursor.style.background = 'radial-gradient(circle, #8b5cf6 0%, transparent 70%)';
            });
            
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursor.style.background = 'radial-gradient(circle, #6366f1 0%, transparent 70%)';
            });
        });
    }
    
    // ===== 9. EFECTOS DE SONIDO (OPCIONAL) =====
    function setupSoundEffects() {
        // Crear contexto de audio
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        
        function playBeep(frequency = 800, duration = 100) {
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.setValueAtTime(frequency, audioContext.currentTime);
            gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + duration / 1000);
            
            oscillator.start();
            oscillator.stop(audioContext.currentTime + duration / 1000);
        }
        
        // Sonidos en hover de menú
        document.querySelectorAll('#menu ul li a').forEach(link => {
            link.addEventListener('mouseenter', () => playBeep(600, 50));
        });
        
        // Sonido en botones
        document.querySelectorAll('.boton, input[type="submit"]').forEach(btn => {
            btn.addEventListener('click', () => playBeep(400, 150));
        });
    }
    
    // ===== 10. EFECTO LOADING INICIAL =====
    function showLoadingEffect() {
        const loadingOverlay = document.createElement('div');
        loadingOverlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        `;
        
        const spinner = document.createElement('div');
        spinner.style.cssText = `
            width: 60px;
            height: 60px;
            border: 3px solid rgba(99,102,241,0.3);
            border-top: 3px solid #6366f1;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        `;
        
        const loadingText = document.createElement('div');
        loadingText.textContent = 'CARGANDO GAMING BLOG...';
        loadingText.style.cssText = `
            color: #6366f1;
            font-family: 'Orbitron', monospace;
            font-size: 1.2rem;
            margin-top: 20px;
            letter-spacing: 2px;
        `;
        
        loadingOverlay.appendChild(spinner);
        loadingOverlay.appendChild(loadingText);
        document.body.appendChild(loadingOverlay);
        
        // Remover loading después de 2 segundos
        setTimeout(() => {
            loadingOverlay.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(loadingOverlay);
            }, 500);
        }, 2000);
    }
    
    // ===== CSS ANIMATIONS DINÁMICAS =====
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes glitch {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-2px); }
            40% { transform: translateX(2px); }
            60% { transform: translateX(-1px); }
            80% { transform: translateX(1px); }
        }
        
        @keyframes floatUp {
            to {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    
    // ===== INICIALIZAR TODOS LOS EFECTOS =====
    showLoadingEffect();
    setupNavEffects();
    createParticles();
    setupSidebarEffects();
    setupInputEffects();
    setupButtonEffects();
    setupScrollEffects();
    setupGamingCursor();
    
    // Efectos de sonido (comentado por defecto, descomenta si quieres sonidos)
    // setupSoundEffects();
    
    console.log('🎮 Gaming Blog Effects Loaded! 🎮');
});

// ===== UTILIDADES ADICIONALES =====

// Función para cambiar tema
function toggleTheme() {
    document.body.classList.toggle('dark-theme');
    localStorage.setItem('theme', document.body.classList.contains('dark-theme') ? 'dark' : 'light');
}

// Aplicar tema guardado
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-theme');
}

// Función para añadir notificaciones gaming
function showGamingNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(16,185,129,0.3);
        z-index: 9999;
        transform: translateX(400px);
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    `;
    
    if (type === 'error') {
        notification.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
        notification.style.boxShadow = '0 10px 25px rgba(239,68,68,0.3)';
    }
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Mostrar notificación
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Ocultar después de 3 segundos
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

