            // Active nav highlight
            const navLinks = document.querySelectorAll('.menu a');
            const currentPage = location
                .pathname
                .split('/')
                .pop() || 'index.html';
            navLinks.forEach(link => {
                const linkPage = link.getAttribute('href');
                if (linkPage === currentPage || (currentPage === '' && linkPage === 'index.html')) {
                    link
                        .classList
                        .add('active');
                }
            });

            // Hamburger toggle
            function toggleMenu() {
                document
                    .getElementById('hamburger')
                    .classList
                    .toggle('open');
                document
                    .getElementById('navMenu')
                    .classList
                    .toggle('open');
            }

            // Close menu when link clicked
            document
                .querySelectorAll('.menu a')
                .forEach(link => {
                    link.addEventListener('click', () => {
                        document
                            .getElementById('hamburger')
                            .classList
                            .remove('open');
                        document
                            .getElementById('navMenu')
                            .classList
                            .remove('open');
                    });
                });
                