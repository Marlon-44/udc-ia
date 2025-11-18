<section class="busqueda__section">
        <canvas id="particles-bg" aria-hidden="true"></canvas>

    <div class="titulo">
        <h1><span>Repositorio</span> Digital</h1>
    </div>
    <div class="busqueda">
        <form class="search-bar" action="#" method="GET">
            <label for="search" class="sr-only">Buscar</label>

            <input type="text" id="search" name="search" placeholder="Buscar..." autocomplete="off">

            <button type="submit" class="search-btn">
                <img src="{{ asset('images/search__icon.svg') }}" alt="Buscar" class="search-icon">

            </button>
        </form>

        <div class="atajos__container">

            <!-- Atajo 1 -->
            <div class="atajo__box " data-filter="colecciones">
                <div class="icon__container rojo">
                    <img src="{{ asset('images/search__icon.svg') }}" alt="Colecciones">

                </div>
                <a href="" class="rojo">Buscar por <br>colecciones</a>

            </div>

            <!-- Atajo 2 -->
            <div class="atajo__box " data-filter="titulo">
                <div class="icon__container amarillo">
                    <img src="{{ asset('images/search__icon.svg') }}" alt="Título">

                </div>
                <a href="" class="amarillo"> Buscar por <br> Título</a>
            </div>

            <!-- Atajo 3 -->
            <div class="atajo__box " data-filter="autor">
                <div class="icon__container rojo">
                    <img src="{{ asset('images/search__icon.svg') }}" alt="Autor">

                </div>
                <a href="" class="rojo">Buscar por<br> Autor</a>
            </div>

            <!-- Atajo 4 -->
            <div class="atajo__box" data-filter="fecha">
                <div class="icon__container amarillo">
                    <img src="{{ asset('images/search__icon.svg') }}" alt="Fecha">

                </div>
                <a href="" class="amarillo">Buscar por <br>Fecha</a>
            </div>

            <!-- Atajo 5 -->
            <div class="atajo__box" data-filter="materias">
                <div class="icon__container rojo">
                    <img src="{{ asset('images/search__icon.svg') }}" alt="Materias">

                </div>
                <a href="" class="rojo">Buscar por <br>Materias</a>
            </div>

            <!-- Atajo 6 -->
            <div class="atajo__box" data-filter="tipo">
                <div class="icon__container amarillo">
                    <img src="{{ asset('images/search__icon.svg') }}" alt="Tipo de material">

                </div>
                <a href="" class="amarillo">Buscar por <br>Tipo de material</a>
            </div>

        </div>
    </div>

</section>
<script>
(function () {
    const section = document.querySelector('.busqueda__section');
    if (!section) return;

    const canvas = document.getElementById('particles-bg');
    const ctx = canvas.getContext('2d');

    // Colores solicitados
    const colors = ['#2563eb', '#1c4aad', '#ffffff'];

    let DPR = window.devicePixelRatio || 1;
    let particles = [];
    const PARTICLE_COUNT = 100; // ajústalo si quieres más o menos
    let mouse = { x: -9999, y: -9999 };

    function resizeCanvas() {
        const rect = section.getBoundingClientRect();
        canvas.width = Math.round(rect.width * DPR);
        canvas.height = Math.round(rect.height * DPR);
        canvas.style.width = rect.width + 'px';
        canvas.style.height = rect.height + 'px';
        ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
    }

    function initParticles() {
        particles = [];
        const rect = section.getBoundingClientRect();
        for (let i = 0; i < PARTICLE_COUNT; i++) {
            particles.push({
                x: Math.random() * rect.width,
                y: Math.random() * rect.height,
                vx: (Math.random() - 0.5) * 0.6,
                vy: (Math.random() - 0.5) * 0.6,
                size: Math.random() * 2.2 + 0.8,
                color: colors[Math.floor(Math.random() * colors.length)],
                life: Math.random() * 100 + 50
            });
        }
    }

    function distance(a, b) {
        const dx = a.x - b.x;
        const dy = a.y - b.y;
        return Math.sqrt(dx * dx + dy * dy);
    }

    function draw() {
        const rect = section.getBoundingClientRect();
        ctx.clearRect(0, 0, rect.width, rect.height);

        const g = ctx.createLinearGradient(0, 0, rect.width, rect.height);
        g.addColorStop(0, 'rgba(37,99,235,0.06)');  
        g.addColorStop(1, 'rgba(28,74,173,0.04)');  
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, rect.width, rect.height);

        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];

            p.x += p.vx;
            p.y += p.vy;

            p.vx += (Math.random() - 0.5) * 0.02;
            p.vy += (Math.random() - 0.5) * 0.02;

            if (p.x < 0) { p.x = 0; p.vx *= -1; }
            if (p.x > rect.width) { p.x = rect.width; p.vx *= -1; }
            if (p.y < 0) { p.y = 0; p.vy *= -1; }
            if (p.y > rect.height) { p.y = rect.height; p.vy *= -1; }

            const m = { x: mouse.x, y: mouse.y };
            if (m.x >= 0) {
                const dist = distance(p, m);
                if (dist < 120) {
                    const force = (120 - dist) / 120;
                    const ang = Math.atan2(p.y - m.y, p.x - m.x);
                    p.vx += Math.cos(ang) * 0.6 * force;
                    p.vy += Math.sin(ang) * 0.6 * force;
                }
            }

            ctx.beginPath();
            ctx.fillStyle = p.color;
            ctx.globalAlpha = 0.85;
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();

            ctx.globalAlpha = 0.12;
            ctx.beginPath();
            ctx.fillStyle = p.color;
            ctx.arc(p.x, p.y, p.size * 6, 0, Math.PI * 2);
            ctx.fill();

            ctx.globalAlpha = 1;
        }

        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const pi = particles[i];
                const pj = particles[j];
                const d = distance(pi, pj);
                if (d < 110) {
                    const alpha = 1 - d / 110;
                    ctx.strokeStyle = 'rgba(37,99,235,' + (0.14 * alpha) + ')'; // usa #2563eb tenue
                    ctx.lineWidth = 0.8;
                    ctx.beginPath();
                    ctx.moveTo(pi.x, pi.y);
                    ctx.lineTo(pj.x, pj.y);
                    ctx.stroke();
                }
            }
        }

        requestAnimationFrame(draw);
    }

    function updateMousePos(e) {
        const rect = section.getBoundingClientRect();
        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        const clientY = e.touches ? e.touches[0].clientY : e.clientY;
        mouse.x = clientX - rect.left;
        mouse.y = clientY - rect.top;
    }

    function clearMouse() {
        mouse.x = -9999;
        mouse.y = -9999;
    }

    window.addEventListener('resize', () => {
        resizeCanvas();
        initParticles();
    });

    section.addEventListener('mousemove', updateMousePos);
    section.addEventListener('mouseleave', clearMouse);
    section.addEventListener('touchmove', updateMousePos, { passive: true });
    section.addEventListener('touchend', clearMouse);

    resizeCanvas();
    initParticles();
    requestAnimationFrame(draw);
})();
</script>
