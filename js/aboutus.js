                const navLinks = document.querySelectorAll('.menu a');
                const currentPage = location
                    .pathname
                    .split('/')
                    .pop() || 'index.html';
                navLinks.forEach(link => {
                    if (link.getAttribute('href') === currentPage) 
                        link
                            .classList
                            .add('active');
                    }
                );
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