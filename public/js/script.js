// Mega Menu Interactive Functionality
document.addEventListener('DOMContentLoaded', () => {
    console.log('Agenda 2063 website loaded');
    
    // Mobile Menu Toggle (PWA Bottom Sheet Style)
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mainNav = document.getElementById('mainNav');
    
    // Create backdrop element
    const backdrop = document.createElement('div');
    backdrop.className = 'mobile-backdrop';
    document.body.appendChild(backdrop);

    function toggleMenu() {
        const isActive = mainNav.classList.contains('active');
        
        if (isActive) {
            // Closing
            mainNav.classList.remove('active');
            backdrop.classList.remove('active');
            const icon = mobileMenuToggle.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            document.body.style.overflow = ''; // Restore scrolling
        } else {
            // Opening
            mainNav.classList.add('active');
            backdrop.classList.add('active');
            const icon = mobileMenuToggle.querySelector('i');
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        }
    }

    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu();
        });

        // Close menu when clicking backdrop
        backdrop.addEventListener('click', () => {
            if (mainNav.classList.contains('active')) {
                toggleMenu();
            }
        });

        // Close menu when clicking a link (optional, but good UX)
        const navLinks = mainNav.querySelectorAll('a:not([href="#"])');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (!link.parentElement.classList.contains('has-dropdown')) {
                    toggleMenu();
                }
            });
        });
    }

    // Mobile Dropdown Toggle
    const dropdownLinks = document.querySelectorAll('.has-dropdown > a');
    
    dropdownLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                e.preventDefault();
                const dropdown = link.nextElementSibling;
                const icon = link.querySelector('i');
                
                // Close other dropdowns
                document.querySelectorAll('.mega-dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.remove('active');
                });
                
                dropdown.classList.toggle('active');
                
                // Rotate icon
                if (dropdown.classList.contains('active')) {
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        });
    });

    // Navigation active state
    const navLinks = document.querySelectorAll('.main-nav > ul > li > a');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (!link.parentElement.classList.contains('has-dropdown')) {
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    });

    // Press Release Rotator
    const pressReleaseLink = document.getElementById('pressReleaseLink');
    if (pressReleaseLink) {
        const pressReleases = [
            {
                text: "African Union launches 2024 Agenda 2063 Continental Progress Report at Addis Ababa Summit",
                link: "news-detail.html"
            },
            {
                text: "AfCFTA Trade Volume Surpasses $50 Billion Milestone - A Historic Achievement for Africa",
                link: "news-detail.html"
            },
            {
                text: "Continental Infrastructure Projects Receive $5 Billion Investment Boost",
                link: "news-detail.html"
            },
            {
                text: "Pan-African University Expands to 10 New Campuses Across the Continent",
                link: "news-detail.html"
            },
            {
                text: "Africa Launches Continental Climate Resilience Strategy at COP28",
                link: "news-detail.html"
            }
        ];

        let currentPressIndex = 0;

        function rotatePressRelease() {
            // Add fade out class
            pressReleaseLink.classList.add('fade-out');
            pressReleaseLink.classList.remove('fade-in');

            setTimeout(() => {
                // Update content
                currentPressIndex = (currentPressIndex + 1) % pressReleases.length;
                pressReleaseLink.textContent = pressReleases[currentPressIndex].text;
                pressReleaseLink.href = pressReleases[currentPressIndex].link;

                // Add fade in class
                pressReleaseLink.classList.remove('fade-out');
                pressReleaseLink.classList.add('fade-in');
            }, 500); // Wait for fade out animation
        }

        // Rotate every 6 seconds
        setInterval(rotatePressRelease, 6000);
    }

    // Hero Carousel Functionality (Updated for 9 cards in sets of 3)
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroIndicators = document.querySelectorAll('.hero-indicator');
    let currentSlideIndex = 0;
    let autoRotateInterval;
    let isHovering = false;

    // Function to switch between sets of 3 cards
    function setActiveSlide(index) {
        heroSlides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        heroIndicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
        currentSlideIndex = index;
    }

    // Function to handle card expansion within a slide
    function setupCardExpansion() {
        heroSlides.forEach(slide => {
            const cards = slide.querySelectorAll('.hero-card');
            
            cards.forEach((card, index) => {
                // Click to expand
                card.addEventListener('click', () => {
                    cards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    
                    // Reset timer on interaction
                    stopAutoRotate();
                    startAutoRotate();
                });

                // Hover to expand
                card.addEventListener('mouseenter', () => {
                    isHovering = true;
                    cards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    stopAutoRotate();
                });

                card.addEventListener('mouseleave', () => {
                    isHovering = false;
                    startAutoRotate();
                });
            });
        });
    }

    function nextSlide() {
        if (!isHovering) {
            const nextIndex = (currentSlideIndex + 1) % heroSlides.length;
            setActiveSlide(nextIndex);
            
            // Reset active card in the new slide to the first one (or middle one for balance)
            const newSlide = heroSlides[nextIndex];
            const cards = newSlide.querySelectorAll('.hero-card');
            cards.forEach(c => c.classList.remove('active'));
            if(cards.length > 0) cards[0].classList.add('active');
        }
    }

    function startAutoRotate() {
        // Clear any existing interval first
        if (autoRotateInterval) clearInterval(autoRotateInterval);
        autoRotateInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoRotate() {
        clearInterval(autoRotateInterval);
    }

    // Click on indicators
    heroIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            setActiveSlide(index);
            stopAutoRotate();
            startAutoRotate();
        });
    });

    // Initialize
    setupCardExpansion();
    startAutoRotate();

    // Campaign Overlay Functionality
    const campaignOverlay = document.getElementById('campaignOverlay');
    const closeCampaign = document.getElementById('closeCampaign');
    const campaignForm = document.getElementById('campaignForm');
    const educationOverlay = document.getElementById('educationOverlay');
    let inactivityTimeout;
    let lastActivityTime = Date.now();
    const isSubscribed = localStorage.getItem('agenda2063_subscribed') === 'true';

    // Function to reset inactivity timer
    function resetInactivityTimer() {
        lastActivityTime = Date.now();
        clearTimeout(inactivityTimeout);

        // Show appropriate overlay after 10 seconds of inactivity
        inactivityTimeout = setTimeout(() => {
            if (isSubscribed && educationOverlay && !educationOverlay.classList.contains('show')) {
                // User already subscribed - show education modal
                educationOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else if (!isSubscribed && campaignOverlay && !campaignOverlay.classList.contains('show')) {
                // User not subscribed - show campaign overlay
                campaignOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }, 10000); // 10 seconds of inactivity
    }

    // Track user activity
    const activityEvents = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];
    
    activityEvents.forEach(event => {
        document.addEventListener(event, resetInactivityTimer, true);
    });

    // Start the inactivity timer on page load
    resetInactivityTimer();

    // Close campaign overlay
    function closeCampaignOverlay() {
        campaignOverlay.classList.remove('show');
        document.body.style.overflow = 'auto';
        resetInactivityTimer();
    }

    closeCampaign.addEventListener('click', closeCampaignOverlay);

    // Close on overlay background click
    campaignOverlay.addEventListener('click', (e) => {
        if (e.target === campaignOverlay) {
            closeCampaignOverlay();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && campaignOverlay.classList.contains('show')) {
            closeCampaignOverlay();
        }
    });

    // Handle campaign form submission via AJAX
    if (campaignForm) {
        campaignForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const errorsDiv = document.getElementById('campaignErrors');
            const successDiv = document.getElementById('campaignSuccess');
            const submitBtn = document.getElementById('campaignSubmitBtn');
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            if (errorsDiv) {
                errorsDiv.style.display = 'none';
                errorsDiv.innerHTML = '';
            }

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';
            }

            const formData = new FormData(campaignForm);

            fetch('/campaign/join', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.content : '',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => { throw data; });
                }
                return response.json();
            })
            .then(data => {
                campaignForm.style.display = 'none';
                if (successDiv) successDiv.style.display = 'block';
                localStorage.setItem('agenda2063_subscribed', 'true');
                localStorage.setItem('agenda2063_email', formData.get('email'));
            })
            .catch(data => {
                if (data && data.errors) {
                    let html = '<ul>';
                    Object.values(data.errors).forEach(msgs => {
                        msgs.forEach(msg => {
                            html += '<li>' + msg + '</li>';
                        });
                    });
                    html += '</ul>';
                    if (errorsDiv) {
                        errorsDiv.innerHTML = html;
                        errorsDiv.style.display = 'block';
                    }
                } else {
                    if (errorsDiv) {
                        errorsDiv.innerHTML = '<p>Something went wrong. Please try again.</p>';
                        errorsDiv.style.display = 'block';
                    }
                }
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Join the Campaign';
                }
            });
        });
    }

    // ===== Education / Gamification Modal =====
    const eduSlides = [
        {
            badge: 'Aspiration 1',
            title: 'A Prosperous Africa',
            desc: 'Agenda 2063 envisions an Africa based on inclusive growth and sustainable development. The goal is to eradicate poverty and build shared prosperity through social and economic transformation.',
            image: 'https://agenda2063.africa/assets/Aspiration1.png',
            question: 'What is the primary economic goal of Agenda 2063?',
            options: [
                'To become dependent on foreign aid',
                'To eradicate poverty and build shared prosperity',
                'To maintain current economic structures',
                'To focus only on oil exports'
            ],
            correct: 1
        },
        {
            badge: 'Aspiration 2',
            title: 'An Integrated Continent',
            desc: 'Africa seeks political unity and integration through initiatives like the African Continental Free Trade Area (AfCFTA), free movement of people, and a single African market.',
            image: 'https://agenda2063.africa/assets/Aspiration2.png',
            question: 'What does AfCFTA stand for?',
            options: [
                'African Continental Free Trade Area',
                'African Central Financial Trade Agreement',
                'African Committee for Free Transportation',
                'African Continental Federation of Trade Agencies'
            ],
            correct: 0
        },
        {
            badge: 'Aspiration 3',
            title: 'Good Governance & Democracy',
            desc: 'Africa aspires to an era of good governance, democracy, respect for human rights, justice, and the rule of law across all member states.',
            question: 'Which of the following is a key pillar of Aspiration 3?',
            image: 'https://agenda2063.africa/assets/Aspiration3.png',
            options: [
                'Military governance',
                'Single-party rule',
                'Respect for human rights and rule of law',
                'Centralized continental authority'
            ],
            correct: 2
        },
        {
            badge: 'Aspiration 4',
            title: 'A Peaceful & Secure Africa',
            desc: 'The vision includes silencing the guns by 2030, with mechanisms for peaceful conflict resolution, counter-terrorism, and human security across the continent.',
            image: 'https://agenda2063.africa/assets/Aspiration4.png',
            question: 'What is the target year for the "Silencing the Guns" initiative?',
            options: [
                '2025',
                '2063',
                '2030',
                '2040'
            ],
            correct: 2
        },
        {
            badge: 'Aspiration 5',
            title: 'Cultural Identity & Heritage',
            desc: 'Africa celebrates its strong cultural identity, common heritage, shared values, and ethics. The Pan-African cultural renaissance drives creativity, arts, and preservation of heritage.',
            image: 'https://agenda2063.africa/assets/Aspiration5.png',
            question: 'How many member states make up the African Union?',
            options: [
                '44',
                '48',
                '54',
                '60'
            ],
            correct: 2
        },
        {
            badge: 'Aspiration 6',
            title: 'People-Driven Development',
            desc: 'Africa\'s development is people-driven, especially unleashing the potential of women and youth. Investment in education, health, and skills development is central to this aspiration.',
            image: 'https://agenda2063.africa/assets/Aspiration6.png',
            question: 'What percentage of Africa\'s population is under 25 years old?',
            options: [
                'About 40%',
                'About 50%',
                'About 60%',
                'About 70%'
            ],
            correct: 2
        },
        {
            badge: 'Aspiration 7',
            title: 'A Strong Global Player',
            desc: 'Africa aims to be a strong, united, resilient, and influential global player and partner with a significant role in world affairs.',
            image: 'https://agenda2063.africa/assets/Aspiration7.png',
            question: 'What is Africa\'s projected population by 2063?',
            options: [
                '1.5 billion',
                '2.0 billion',
                '2.5 billion',
                '3.0 billion'
            ],
            correct: 2
        },
        {
            badge: 'Flagship Project',
            title: 'African Continental Free Trade Area',
            desc: 'The AfCFTA is the world\'s largest free trade area by number of participating countries. It aims to boost intra-African trade, create a single market, and accelerate industrialization.',
            image: 'https://agenda2063.africa/assets/Aspiration1.png',
            question: 'How many countries have signed the AfCFTA agreement?',
            options: [
                '34 countries',
                '44 countries',
                '54 countries',
                '64 countries'
            ],
            correct: 2
        },
        {
            badge: 'Flagship Project',
            title: 'The African Passport',
            desc: 'The African Passport initiative aims to facilitate free movement of people across Africa, strengthen ties among Africans, and promote tourism and business travel across the continent.',
            image: 'https://agenda2063.africa/assets/Aspiration2.png',
            question: 'What is the main purpose of the African Passport?',
            options: [
                'To replace all national passports',
                'To facilitate free movement of people across Africa',
                'To restrict travel to certain countries',
                'To serve as an ID card only'
            ],
            correct: 1
        },
        {
            badge: 'Flagship Project',
            title: 'Pan-African E-Network',
            desc: 'The digital transformation of Africa includes building high-speed internet infrastructure, expanding digital literacy, fostering tech innovation hubs, and bridging the digital divide.',
            image: 'https://agenda2063.africa/assets/Aspiration6.png',
            question: 'What is a key goal of Africa\'s digital transformation strategy?',
            options: [
                'Limiting internet access to cities',
                'Bridging the digital divide and expanding connectivity',
                'Relying solely on satellite internet',
                'Outsourcing all tech development'
            ],
            correct: 1
        },
        {
            badge: 'Flagship Project',
            title: 'Silencing the Guns Initiative',
            desc: 'This flagship initiative seeks to end all wars, civil conflicts, gender-based violence, and prevent genocide in the continent. It represents Africa\'s determination to achieve peace.',
            image: 'https://agenda2063.africa/assets/Aspiration4.png',
            question: 'What does the "Silencing the Guns" initiative aim to achieve?',
            options: [
                'Reduce military spending only',
                'End all wars, civil conflicts, and gender-based violence',
                'Build more military bases',
                'Create a continental army'
            ],
            correct: 1
        }
    ];

    // Education Modal State
    let currentEduSlide = 0;
    let eduScore = 0;
    let eduAnswered = 0;
    let eduAnswers = new Array(eduSlides.length).fill(null);

    // DOM elements for education modal
    const eduOverlay = document.getElementById('educationOverlay');
    const closeEdu = document.getElementById('closeEducation');
    const closeEduComplete = document.getElementById('closeEducationComplete');
    const eduProgressFill = document.getElementById('eduProgressFill');
    const eduProgressText = document.getElementById('eduProgressText');
    const eduSlideImg = document.getElementById('eduSlideImg');
    const eduSlideBadge = document.getElementById('eduSlideBadge');
    const eduSlideTitle = document.getElementById('eduSlideTitle');
    const eduSlideDesc = document.getElementById('eduSlideDesc');
    const eduQuizQuestion = document.getElementById('eduQuizQuestion');
    const eduQuizOptions = document.getElementById('eduQuizOptions');
    const eduQuizFeedback = document.getElementById('eduQuizFeedback');
    const feedbackIcon = document.getElementById('feedbackIcon');
    const feedbackMessage = document.getElementById('feedbackMessage');
    const eduPrevBtn = document.getElementById('eduPrevBtn');
    const eduNextBtn = document.getElementById('eduNextBtn');
    const eduScoreValue = document.getElementById('eduScoreValue');
    const eduScoreTotal = document.getElementById('eduScoreTotal');
    const eduSlideDots = document.getElementById('eduSlideDots');
    const eduCompletion = document.getElementById('eduCompletion');
    const eduRetryBtn = document.getElementById('eduRetryBtn');
    const eduCloseBtn = document.getElementById('eduCloseBtn');

    if (eduOverlay) {
        // Build slide dots
        eduSlides.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.className = 'edu-dot' + (i === 0 ? ' active' : '');
            dot.addEventListener('click', () => {
                if (eduAnswers[i] !== null || i <= eduAnswered) {
                    goToEduSlide(i);
                }
            });
            eduSlideDots.appendChild(dot);
        });

        // Render initial slide
        renderEduSlide(0);

        // Navigation buttons
        eduPrevBtn.addEventListener('click', () => {
            if (currentEduSlide > 0) goToEduSlide(currentEduSlide - 1);
        });

        eduNextBtn.addEventListener('click', () => {
            if (currentEduSlide < eduSlides.length - 1) {
                goToEduSlide(currentEduSlide + 1);
            } else {
                showEduCompletion();
            }
        });

        // Close education overlay
        function closeEducationOverlay() {
            eduOverlay.classList.remove('show');
            document.body.style.overflow = 'auto';
            resetInactivityTimer();
        }

        closeEdu.addEventListener('click', closeEducationOverlay);
        if (closeEduComplete) {
            closeEduComplete.addEventListener('click', closeEducationOverlay);
        }

        eduOverlay.addEventListener('click', (e) => {
            if (e.target === eduOverlay) closeEducationOverlay();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && eduOverlay.classList.contains('show')) {
                closeEducationOverlay();
            }
        });

        // Retry button
        if (eduRetryBtn) {
            eduRetryBtn.addEventListener('click', () => {
                currentEduSlide = 0;
                eduScore = 0;
                eduAnswered = 0;
                eduAnswers = new Array(eduSlides.length).fill(null);
                eduCompletion.style.display = 'none';
                document.querySelector('.education-left').style.display = '';
                document.querySelector('.education-right').style.display = '';
                updateEduDots();
                renderEduSlide(0);
            });
        }

        // Close/Done button
        if (eduCloseBtn) {
            eduCloseBtn.addEventListener('click', closeEducationOverlay);
        }
    }

    function goToEduSlide(index) {
        currentEduSlide = index;
        renderEduSlide(index);
        updateEduDots();
    }

    function renderEduSlide(index) {
        const slide = eduSlides[index];
        if (!slide) return;

        // Update left panel
        eduSlideImg.src = slide.image;
        eduSlideImg.alt = slide.title;
        eduProgressFill.style.width = ((eduAnswered / eduSlides.length) * 100) + '%';
        eduProgressText.textContent = eduAnswered + ' / ' + eduSlides.length;
        eduScoreValue.textContent = eduScore;
        eduScoreTotal.textContent = eduAnswered;

        // Update right panel
        eduSlideBadge.textContent = slide.badge;
        eduSlideTitle.textContent = slide.title;
        eduSlideDesc.textContent = slide.desc;
        eduQuizQuestion.textContent = slide.question;

        // Update navigation
        eduPrevBtn.disabled = (index === 0);

        // Render quiz options
        eduQuizOptions.innerHTML = '';
        eduQuizFeedback.style.display = 'none';
        const letters = ['A', 'B', 'C', 'D'];

        slide.options.forEach((option, i) => {
            const optionEl = document.createElement('div');
            optionEl.className = 'edu-quiz-option';
            optionEl.innerHTML = `<span class="option-letter">${letters[i]}</span><span>${option}</span>`;

            // Check if this slide was already answered
            if (eduAnswers[index] !== null) {
                optionEl.classList.add('disabled');
                if (i === slide.correct) {
                    optionEl.classList.add('correct');
                }
                if (i === eduAnswers[index] && i !== slide.correct) {
                    optionEl.classList.add('incorrect');
                }
                // Show feedback for previously answered
                showEduFeedback(eduAnswers[index] === slide.correct);
                eduNextBtn.disabled = false;
            } else {
                // Not yet answered - allow clicking
                eduNextBtn.disabled = true;
                optionEl.addEventListener('click', () => handleEduAnswer(index, i));
            }

            eduQuizOptions.appendChild(optionEl);
        });

        updateEduDots();
    }

    function handleEduAnswer(slideIndex, selectedIndex) {
        const slide = eduSlides[slideIndex];
        const isCorrect = selectedIndex === slide.correct;

        // Store answer
        eduAnswers[slideIndex] = selectedIndex;
        eduAnswered++;
        if (isCorrect) eduScore++;

        // Update options visually
        const options = eduQuizOptions.querySelectorAll('.edu-quiz-option');
        options.forEach((opt, i) => {
            opt.classList.add('disabled');
            if (i === slide.correct) opt.classList.add('correct');
            if (i === selectedIndex && !isCorrect) opt.classList.add('incorrect');
        });

        // Show feedback
        showEduFeedback(isCorrect);

        // Enable next button
        eduNextBtn.disabled = false;
        if (currentEduSlide === eduSlides.length - 1) {
            eduNextBtn.innerHTML = 'Finish <i class="fa-solid fa-flag-checkered"></i>';
        }

        // Update progress
        eduProgressFill.style.width = ((eduAnswered / eduSlides.length) * 100) + '%';
        eduProgressText.textContent = eduAnswered + ' / ' + eduSlides.length;
        eduScoreValue.textContent = eduScore;
        eduScoreTotal.textContent = eduAnswered;

        // Update dots
        updateEduDots();

        // Save answer to server
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const userEmail = localStorage.getItem('agenda2063_email') || '';

        fetch('/quiz/answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken ? csrfToken.content : '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                email: userEmail,
                slide_number: slideIndex + 1,
                question: slide.question,
                selected_answer: slide.options[selectedIndex],
                is_correct: isCorrect,
            }),
        }).catch(() => {});
    }

    function showEduFeedback(isCorrect) {
        eduQuizFeedback.style.display = 'flex';
        eduQuizFeedback.className = 'edu-quiz-feedback ' + (isCorrect ? 'correct' : 'incorrect');
        feedbackIcon.innerHTML = isCorrect
            ? '<i class="fa-solid fa-circle-check"></i>'
            : '<i class="fa-solid fa-circle-xmark"></i>';

        const correctMessages = [
            'Excellent! You know your Africa!',
            'Great job! Keep it up!',
            'Correct! You\'re a true Pan-Africanist!',
            'Well done! Africa is proud!',
            'Brilliant! You\'re learning fast!'
        ];
        const incorrectMessages = [
            'Not quite! But now you know!',
            'Good try! Learning is a journey.',
            'Almost there! Keep exploring!',
            'No worries! Every answer teaches something.'
        ];

        const messages = isCorrect ? correctMessages : incorrectMessages;
        feedbackMessage.textContent = messages[Math.floor(Math.random() * messages.length)];
    }

    function updateEduDots() {
        const dots = eduSlideDots.querySelectorAll('.edu-dot');
        dots.forEach((dot, i) => {
            dot.className = 'edu-dot';
            if (i === currentEduSlide) dot.classList.add('active');
            if (eduAnswers[i] !== null) {
                dot.classList.add('answered');
                dot.classList.add(eduAnswers[i] === eduSlides[i].correct ? 'correct' : 'incorrect');
            }
        });
    }

    function showEduCompletion() {
        document.querySelector('.education-left').style.display = 'none';
        document.querySelector('.education-right').style.display = 'none';
        eduCompletion.style.display = 'flex';

        // Stars: 3 stars for 8+, 2 for 5-7, 1 for 1-4, 0 for 0
        const starCount = eduScore >= 8 ? 3 : eduScore >= 5 ? 2 : eduScore >= 1 ? 1 : 0;
        const starsEl = document.getElementById('eduStars');
        starsEl.innerHTML = '';
        for (let i = 0; i < 3; i++) {
            const star = document.createElement('i');
            star.className = 'fa-solid fa-star' + (i < starCount ? ' earned' : '');
            star.style.animationDelay = (i * 0.2) + 's';
            starsEl.appendChild(star);
        }

        // Completion messages
        const titles = {
            3: 'Outstanding!',
            2: 'Well Done!',
            1: 'Good Effort!',
            0: 'Keep Learning!'
        };
        const messages = {
            3: 'You\'re a true champion of Africa\'s vision! Your knowledge of Agenda 2063 is impressive.',
            2: 'Great work! You have a solid understanding of Africa\'s transformation journey.',
            1: 'A good start! Keep exploring Agenda 2063 to learn more about Africa\'s future.',
            0: 'Every expert was once a beginner. Come back and try again to learn about Africa\'s amazing vision!'
        };

        document.getElementById('completionTitle').textContent = titles[starCount];
        document.getElementById('completionScore').textContent = 'You scored ' + eduScore + ' out of ' + eduSlides.length;
        document.getElementById('completionMessage').textContent = messages[starCount];
    }

    // Mega Menu Data Structure
    const menuData = {
        // ===== ABOUT MENU =====
        overview: {
            title: 'Overview',
            description: 'Agenda 2063 is Africa\'s blueprint and master plan for transforming the continent into a global powerhouse of the future.',
            items: [
                { name: 'What is Agenda 2063?', desc: 'A strategic framework for socio-economic transformation of the continent over 50 years', icon: 'fa-solid fa-globe-africa' },
                { name: 'The 7 Aspirations', desc: 'The seven aspirations that reflect the desire for shared prosperity and well-being', icon: 'fa-solid fa-star' },
                { name: 'Goals & Priority Areas', desc: '20 goals and 39 priority areas driving Africa\'s transformation agenda', icon: 'fa-solid fa-bullseye' },
                { name: 'Implementation Plan', desc: 'Broken into 10-year implementation plans with clear targets and milestones', icon: 'fa-solid fa-tasks' },
                { name: 'Timeline & Milestones', desc: 'Key milestones from 2013 adoption through the 2063 vision horizon', icon: 'fa-solid fa-timeline' }
            ]
        },
        vision: {
            title: 'Vision & Mission',
            description: 'An integrated, prosperous and peaceful Africa, driven by its own citizens and representing a dynamic force in the global arena.',
            items: [
                { name: 'The Africa We Want', desc: 'A prosperous continent with the means and resources to drive its own development', icon: 'fa-solid fa-eye' },
                { name: 'Mission Statement', desc: 'To build an integrated, prosperous and peaceful Africa driven by its own citizens', icon: 'fa-solid fa-rocket' },
                { name: 'Core Values', desc: 'Pan-Africanism, self-reliance, gender equality, youth empowerment, and social inclusion', icon: 'fa-solid fa-heart' },
                { name: 'Guiding Principles', desc: 'African ownership, inclusiveness, accountability, transparency, and subsidiarity', icon: 'fa-solid fa-compass' },
                { name: 'Strategic Priorities', desc: 'Economic transformation, human capital, agriculture, industrialization, and peace', icon: 'fa-solid fa-chess' }
            ]
        },
        history: {
            title: 'History',
            description: 'From the Organisation of African Unity (OAU) to Agenda 2063 - a journey of Pan-African unity and self-determination.',
            items: [
                { name: 'Origins & OAU Legacy', desc: 'From the founding of the OAU in 1963 to the birth of the African Union in 2002', icon: 'fa-solid fa-landmark' },
                { name: 'Pan-African Movement', desc: 'The Pan-African movement\'s influence on continental integration and solidarity', icon: 'fa-solid fa-people-group' },
                { name: 'The 50th Anniversary', desc: 'AU\'s Golden Jubilee in 2013 which led to the adoption of Agenda 2063', icon: 'fa-solid fa-award' },
                { name: 'Key Decisions & Declarations', desc: 'Major AU summits and declarations that shaped the Agenda 2063 framework', icon: 'fa-solid fa-gavel' },
                { name: 'From NEPAD to Agenda 2063', desc: 'Evolution from NEPAD and other frameworks into the comprehensive Agenda 2063', icon: 'fa-solid fa-arrows-spin' }
            ]
        },
        framework: {
            title: 'Framework',
            description: 'A results-based framework for monitoring, evaluation, and reporting on Agenda 2063 implementation.',
            items: [
                { name: 'First Ten-Year Plan', desc: '2014-2023 implementation plan focusing on quick wins and foundational goals', icon: 'fa-solid fa-calendar-check' },
                { name: 'Second Ten-Year Plan', desc: '2024-2033 plan building on first decade achievements with expanded targets', icon: 'fa-solid fa-calendar-plus' },
                { name: 'Monitoring & Evaluation', desc: 'Continental M&E framework with biennial reporting and country-level tracking', icon: 'fa-solid fa-chart-line' },
                { name: 'Results Framework', desc: 'National, regional, and continental indicators aligned with AU goals', icon: 'fa-solid fa-diagram-project' },
                { name: 'Domestication Process', desc: 'How member states integrate Agenda 2063 into national development plans', icon: 'fa-solid fa-file-signature' }
            ]
        },
        partners: {
            title: 'Partners',
            description: 'Collaboration between AU member states, regional economic communities, and global development partners.',
            items: [
                { name: 'AU Member States', desc: '55 member states driving implementation at the national and regional level', icon: 'fa-solid fa-flag' },
                { name: 'Regional Economic Communities', desc: '8 RECs coordinating regional integration: ECOWAS, SADC, EAC, COMESA, and more', icon: 'fa-solid fa-handshake' },
                { name: 'UN & International Partners', desc: 'Alignment with UN SDGs and partnerships with UN agencies and global bodies', icon: 'fa-solid fa-earth-americas' },
                { name: 'Private Sector & Business', desc: 'Engaging Africa\'s private sector for investment, innovation, and economic growth', icon: 'fa-solid fa-building' },
                { name: 'Civil Society & Diaspora', desc: 'Engagement of civil society organizations, youth groups, and the African diaspora', icon: 'fa-solid fa-users' }
            ]
        },
        leadership: {
            title: 'Leadership',
            description: 'The governance structure driving the implementation and oversight of Agenda 2063.',
            items: [
                { name: 'AU Commission Chairperson', desc: 'Overall leadership of the African Union Commission and its operations', icon: 'fa-solid fa-user-tie' },
                { name: 'Assembly of Heads of State', desc: 'Supreme organ of the AU providing political leadership and strategic direction', icon: 'fa-solid fa-crown' },
                { name: 'Executive Council', desc: 'Ministers of Foreign Affairs coordinating policies and decisions', icon: 'fa-solid fa-briefcase' },
                { name: 'AUDA-NEPAD', desc: 'African Union Development Agency implementing continental development programs', icon: 'fa-solid fa-cogs' },
                { name: 'Specialized Technical Committees', desc: '14 STCs covering sectors from economy to health, education, and infrastructure', icon: 'fa-solid fa-sitemap' }
            ]
        },

        aspirations: {
            title: 'The 7 Aspirations',
            description: 'Seven aspirations reflecting the collective vision of the African people for the continent they want.',
            items: [
                { name: 'A Prosperous Africa', desc: 'Inclusive growth, sustainable development, and economic transformation for all', icon: 'fa-solid fa-coins' },
                { name: 'An Integrated Continent', desc: 'Political unity based on Pan-Africanism and the vision of Africa\'s Renaissance', icon: 'fa-solid fa-puzzle-piece' },
                { name: 'Good Governance & Democracy', desc: 'A continent of democratic values, justice, rule of law, and respect for human rights', icon: 'fa-solid fa-balance-scale' },
                { name: 'Peace & Security', desc: 'A peaceful and secure Africa with conflict prevention and resolution mechanisms', icon: 'fa-solid fa-dove' },
                { name: 'Strong Cultural Identity', desc: 'An Africa with a strong cultural identity, common heritage, and shared values', icon: 'fa-solid fa-masks-theater' }
            ]
        },
        goals: {
            title: 'Goals & Targets',
            description: 'Agenda 2063 defines 20 goals grouped under the 7 aspirations with measurable targets.',
            items: [
                { name: 'The 20 Goals', desc: 'High-level goals spanning income growth, education, health, governance, and peace', icon: 'fa-solid fa-list-ol' },
                { name: '39 Priority Areas', desc: 'Specific priority areas that drive focused implementation across sectors', icon: 'fa-solid fa-crosshairs' },
                { name: 'Continental Targets', desc: 'Measurable targets at continental level for each implementation decade', icon: 'fa-solid fa-chart-bar' },
                { name: 'National Targets', desc: 'How member states translate continental goals into national development plans', icon: 'fa-solid fa-flag-checkered' },
                { name: 'Indicators & Metrics', desc: 'Over 300 indicators for monitoring progress at national and continental level', icon: 'fa-solid fa-tachometer-alt' }
            ]
        },
        'member-states': {
            title: 'Member States',
            description: 'All 55 African Union member states participating in Agenda 2063 implementation.',
            items: [
                { name: 'Member State Directory', desc: 'Full directory of all 55 AU member states with country profiles', icon: 'fa-solid fa-earth-africa' },
                { name: 'Country Implementation Status', desc: 'Track each country\'s progress in domesticating Agenda 2063 into national plans', icon: 'fa-solid fa-clipboard-list' },
                { name: 'Regional Groupings', desc: 'Countries organized by Regional Economic Communities: ECOWAS, SADC, EAC, COMESA, etc.', icon: 'fa-solid fa-layer-group' },
                { name: 'National Focal Points', desc: 'Contact details for Agenda 2063 focal points in each member state', icon: 'fa-solid fa-address-book' },
                { name: 'Country Reports', desc: 'National progress reports and voluntary reviews submitted by member states', icon: 'fa-solid fa-file-alt' }
            ]
        },
        'au-organs': {
            title: 'AU Organs',
            description: 'The key organs of the African Union driving continental governance and policy implementation.',
            items: [
                { name: 'The Assembly', desc: 'Supreme organ of AU comprising Heads of State and Government of member states', icon: 'fa-solid fa-crown' },
                { name: 'The Commission', desc: 'Secretariat of the AU responsible for day-to-day management and coordination', icon: 'fa-solid fa-building-columns' },
                { name: 'Pan-African Parliament', desc: 'Legislative body providing a platform for all African peoples in governance', icon: 'fa-solid fa-landmark' },
                { name: 'African Court of Justice', desc: 'Principal judicial organ ensuring adherence to AU treaties and protocols', icon: 'fa-solid fa-gavel' },
                { name: 'ECOSOCC', desc: 'Economic, Social and Cultural Council for civil society participation in the AU', icon: 'fa-solid fa-people-group' }
            ]
        },
        achievements: {
            title: 'Key Achievements',
            description: 'Major milestones and accomplishments achieved since the launch of Agenda 2063.',
            items: [
                { name: 'AfCFTA Launch', desc: 'Successful establishment of the African Continental Free Trade Area in 2021', icon: 'fa-solid fa-trophy' },
                { name: 'Free Movement Protocol', desc: 'Adoption of the Protocol on Free Movement of Persons across the continent', icon: 'fa-solid fa-person-walking-luggage' },
                { name: 'Silencing the Guns Progress', desc: 'Significant reduction in armed conflicts and strengthened peacekeeping capacity', icon: 'fa-solid fa-shield-halved' },
                { name: 'Infrastructure Milestones', desc: 'Progress on PIDA projects connecting energy, transport, and ICT networks', icon: 'fa-solid fa-road' },
                { name: 'Education & Health Gains', desc: 'Improved school enrollment rates and expanded healthcare access across Africa', icon: 'fa-solid fa-graduation-cap' }
            ]
        },
        'ten-year-plans': {
            title: '10-Year Implementation Plans',
            description: 'Agenda 2063 is divided into five sequential 10-year implementation plans through 2063.',
            items: [
                { name: 'First Plan (2014-2023)', desc: 'Foundation decade focusing on quick wins and establishing institutional frameworks', icon: 'fa-solid fa-calendar-check' },
                { name: 'Second Plan (2024-2033)', desc: 'Current decade building on achievements with accelerated continental integration', icon: 'fa-solid fa-calendar-plus' },
                { name: 'Third Plan (2034-2043)', desc: 'Projected decade for consolidated economic transformation and industrialization', icon: 'fa-solid fa-calendar-days' },
                { name: 'Fourth Plan (2044-2053)', desc: 'Advancing toward full continental integration and global competitiveness', icon: 'fa-solid fa-calendar-week' },
                { name: 'Fifth Plan (2054-2063)', desc: 'Final decade achieving the full Agenda 2063 vision of "The Africa We Want"', icon: 'fa-solid fa-calendar-alt' }
            ]
        },

        // ===== PERFORMANCE MENU =====
        reports: {
            title: 'Annual Reports',
            description: 'Comprehensive annual and biennial reports tracking Africa\'s progress toward Agenda 2063 goals.',
            items: [
                { name: '2024 Continental Report', desc: 'Latest biennial report on Agenda 2063 implementation across all member states', icon: 'fa-solid fa-file-alt' },
                { name: '2023 Mid-Year Review', desc: 'Mid-year assessment of goal progress and policy implementation updates', icon: 'fa-solid fa-file-lines' },
                { name: 'First Ten-Year Review', desc: 'Comprehensive review of 2014-2023 decade achievements and lessons learned', icon: 'fa-solid fa-book-open' },
                { name: 'Regional Performance Reports', desc: 'Detailed reports from each Regional Economic Community on their progress', icon: 'fa-solid fa-map' },
                { name: 'Thematic Reports', desc: 'Sector-specific reports on education, health, infrastructure, peace, and trade', icon: 'fa-solid fa-layer-group' }
            ]
        },
        indicators: {
            title: 'Key Indicators',
            description: 'Core indicators measuring Africa\'s progress across economic, social, and governance dimensions.',
            items: [
                { name: 'GDP & Economic Growth', desc: 'Continental and national GDP growth, per capita income, and economic diversification', icon: 'fa-solid fa-chart-pie' },
                { name: 'Human Development Index', desc: 'Health, education, and standard of living indicators across African nations', icon: 'fa-solid fa-heart-pulse' },
                { name: 'Infrastructure Index', desc: 'Progress on energy access, ICT connectivity, roads, and transport networks', icon: 'fa-solid fa-road' },
                { name: 'Governance & Democracy', desc: 'Ibrahim Index scores, electoral participation, and institutional quality', icon: 'fa-solid fa-scale-balanced' },
                { name: 'Trade & Integration', desc: 'Intra-African trade volumes, tariff reductions, and cross-border movement', icon: 'fa-solid fa-exchange-alt' }
            ]
        },
        progress: {
            title: 'Progress Dashboard',
            description: 'Interactive dashboard tracking real-time progress on all 7 aspirations and 20 goals.',
            items: [
                { name: 'Overall Score Card', desc: 'Aggregate continental performance score across all Agenda 2063 goals', icon: 'fa-solid fa-gauge-high' },
                { name: 'Aspiration Tracker', desc: 'Progress breakdown for each of the 7 aspirations with goal-level detail', icon: 'fa-solid fa-chart-bar' },
                { name: 'Country Comparisons', desc: 'Compare implementation progress between individual member states', icon: 'fa-solid fa-ranking-star' },
                { name: 'Regional Heat Maps', desc: 'Geographic visualization of performance across Africa\'s five regions', icon: 'fa-solid fa-map-location-dot' },
                { name: 'Trend Analysis', desc: 'Year-over-year trends showing acceleration or deceleration of progress', icon: 'fa-solid fa-arrow-trend-up' }
            ]
        },
        evaluation: {
            title: 'Evaluation Framework',
            description: 'The methodology and tools used to assess implementation quality and impact.',
            items: [
                { name: 'M&E Methodology', desc: 'Results-based management approach with theory of change and logic models', icon: 'fa-solid fa-microscope' },
                { name: 'Performance Criteria', desc: 'Relevance, effectiveness, efficiency, impact, and sustainability criteria', icon: 'fa-solid fa-clipboard-check' },
                { name: 'Impact Evaluation', desc: 'Assessment of long-term transformational outcomes on African populations', icon: 'fa-solid fa-magnifying-glass-chart' },
                { name: 'Peer Review Mechanism', desc: 'African Peer Review Mechanism (APRM) for governance and policy assessment', icon: 'fa-solid fa-people-arrows' },
                { name: 'Reporting Guidelines', desc: 'Standardized reporting templates and guidelines for member states', icon: 'fa-solid fa-list-check' }
            ]
        },
        data: {
            title: 'Data & Statistics',
            description: 'Comprehensive statistical resources and open data portals for evidence-based analysis.',
            items: [
                { name: 'AU Statistical Yearbook', desc: 'Annual compendium of key socio-economic statistics for all member states', icon: 'fa-solid fa-database' },
                { name: 'Country Data Profiles', desc: 'Detailed country-level data sheets with 200+ indicators per nation', icon: 'fa-solid fa-id-card' },
                { name: 'Data Visualization Tools', desc: 'Interactive charts, maps, and dashboards for exploring continental data', icon: 'fa-solid fa-chart-area' },
                { name: 'Open Data Portal', desc: 'Publicly accessible datasets for researchers, policymakers, and citizens', icon: 'fa-solid fa-unlock' },
                { name: 'Data Quality Standards', desc: 'Harmonized data collection standards and quality assurance protocols', icon: 'fa-solid fa-shield-halved' }
            ]
        },
        benchmarks: {
            title: 'Benchmarks',
            description: 'Continental targets, best practices, and success stories that set the standard for implementation.',
            items: [
                { name: 'Continental Targets', desc: 'Specific quantitative targets for each goal by 2033 and 2063 milestones', icon: 'fa-solid fa-crosshairs' },
                { name: 'Best Performing Countries', desc: 'Spotlight on top-performing nations and their strategies for success', icon: 'fa-solid fa-trophy' },
                { name: 'Best Practices Repository', desc: 'Documented best practices from across the continent for knowledge sharing', icon: 'fa-solid fa-lightbulb' },
                { name: 'Success Stories', desc: 'Real impact stories from communities and nations transformed by Agenda 2063', icon: 'fa-solid fa-medal' },
                { name: 'Global Comparisons', desc: 'How Africa\'s progress compares to global benchmarks and other regions', icon: 'fa-solid fa-globe' }
            ]
        },

        scorecards: {
            title: 'Score Cards',
            description: 'Continental and national score cards measuring performance against Agenda 2063 targets.',
            items: [
                { name: 'Continental Score Card', desc: 'Aggregate performance score across all 20 goals and 7 aspirations', icon: 'fa-solid fa-clipboard-check' },
                { name: 'Regional Score Cards', desc: 'Performance breakdown by Africa\'s five geographic regions', icon: 'fa-solid fa-map-location-dot' },
                { name: 'Aspiration Scores', desc: 'Detailed scoring for each of the 7 aspirations with goal-level analysis', icon: 'fa-solid fa-star-half-stroke' },
                { name: 'Year-on-Year Comparison', desc: 'Track how scores have changed over successive reporting periods', icon: 'fa-solid fa-arrows-left-right' },
                { name: 'Download Score Cards', desc: 'Downloadable score card PDFs for presentations and policy use', icon: 'fa-solid fa-download' }
            ]
        },
        'country-profiles': {
            title: 'Country Profiles',
            description: 'Detailed performance profiles for each of the 55 AU member states.',
            items: [
                { name: 'Country Dashboard', desc: 'Interactive dashboard showing each country\'s Agenda 2063 performance', icon: 'fa-solid fa-gauge-high' },
                { name: 'Comparative Rankings', desc: 'Compare member states on key indicators and overall implementation progress', icon: 'fa-solid fa-ranking-star' },
                { name: 'Strengths & Gaps', desc: 'Analysis of each country\'s strongest and weakest performing areas', icon: 'fa-solid fa-magnifying-glass-chart' },
                { name: 'Country Fact Sheets', desc: 'One-page fact sheets summarizing key data and achievements per country', icon: 'fa-solid fa-id-card' },
                { name: 'Data Explorer', desc: 'Explore raw data by country, indicator, and time period', icon: 'fa-solid fa-table' }
            ]
        },
        'regional-analysis': {
            title: 'Regional Analysis',
            description: 'In-depth performance analysis across Africa\'s five regions and 8 RECs.',
            items: [
                { name: 'North Africa', desc: 'Performance analysis for Algeria, Egypt, Libya, Mauritania, Morocco, Tunisia, and Sahrawi Republic', icon: 'fa-solid fa-location-dot' },
                { name: 'West Africa (ECOWAS)', desc: 'Regional analysis for 15 ECOWAS member states and progress on integration', icon: 'fa-solid fa-location-dot' },
                { name: 'East Africa (EAC)', desc: 'Performance review for East African Community members and regional initiatives', icon: 'fa-solid fa-location-dot' },
                { name: 'Southern Africa (SADC)', desc: 'SADC region performance on trade, infrastructure, and peace indicators', icon: 'fa-solid fa-location-dot' },
                { name: 'Central Africa (ECCAS)', desc: 'Progress analysis for Central African states on security, governance, and development', icon: 'fa-solid fa-location-dot' }
            ]
        },
        'sdg-alignment': {
            title: 'SDG Alignment',
            description: 'How Agenda 2063 goals align with and complement the UN Sustainable Development Goals.',
            items: [
                { name: 'Mapping Framework', desc: 'Goal-by-goal mapping between Agenda 2063 and the 17 UN SDGs', icon: 'fa-solid fa-diagram-project' },
                { name: 'Shared Indicators', desc: 'Common indicators used for both Agenda 2063 and SDG reporting', icon: 'fa-solid fa-link' },
                { name: 'Integrated Reporting', desc: 'How member states report on both frameworks through unified mechanisms', icon: 'fa-solid fa-file-circle-check' },
                { name: 'Joint Progress Reports', desc: 'Combined progress assessments showing Africa\'s contribution to global goals', icon: 'fa-solid fa-file-lines' },
                { name: 'Partnership Synergies', desc: 'UN-AU partnership on development financing, data, and technical assistance', icon: 'fa-solid fa-handshake' }
            ]
        },
        'impact-stories': {
            title: 'Impact Stories',
            description: 'Real stories of transformation from communities and nations implementing Agenda 2063.',
            items: [
                { name: 'Community Voices', desc: 'Firsthand accounts from citizens whose lives improved through Agenda 2063 programs', icon: 'fa-solid fa-comments' },
                { name: 'Youth Success Stories', desc: 'Young Africans making an impact through entrepreneurship, innovation, and leadership', icon: 'fa-solid fa-user-graduate' },
                { name: 'Women Empowerment', desc: 'Stories of women leading change in business, governance, and community development', icon: 'fa-solid fa-venus' },
                { name: 'Infrastructure Impact', desc: 'How new roads, energy, and connectivity are transforming African communities', icon: 'fa-solid fa-bridge' },
                { name: 'Trade & Enterprise', desc: 'Businesses and traders benefiting from AfCFTA and regional integration initiatives', icon: 'fa-solid fa-shop' }
            ]
        },
        methodology: {
            title: 'Methodology',
            description: 'The scientific methodology and data standards behind Agenda 2063 performance measurement.',
            items: [
                { name: 'Data Collection Standards', desc: 'Harmonized data collection methods used across all 55 member states', icon: 'fa-solid fa-database' },
                { name: 'Scoring Methodology', desc: 'How aggregate scores are calculated from raw indicators and data sources', icon: 'fa-solid fa-calculator' },
                { name: 'Quality Assurance', desc: 'Data validation processes, peer review, and quality control mechanisms', icon: 'fa-solid fa-shield-halved' },
                { name: 'Technical Guidelines', desc: 'Detailed technical manuals for national statistics offices and data producers', icon: 'fa-solid fa-book' },
                { name: 'Capacity Building', desc: 'Training programs strengthening national statistical capacities across Africa', icon: 'fa-solid fa-person-chalkboard' }
            ]
        },

        // ===== NEWS & EVENTS MENU =====
        news: {
            title: 'Latest News',
            description: 'Stay updated with the latest developments, achievements, and stories from across the continent.',
            items: [
                { name: 'Breaking News', desc: 'Real-time updates on major AU decisions, summits, and continental developments', icon: 'fa-solid fa-bolt' },
                { name: 'Featured Stories', desc: 'In-depth articles on key Agenda 2063 initiatives and their impact on Africa', icon: 'fa-solid fa-newspaper' },
                { name: 'Regional Updates', desc: 'News from all five African regions: North, South, East, West, and Central', icon: 'fa-solid fa-earth-africa' },
                { name: 'Member State Highlights', desc: 'Country-level news on national implementation and development achievements', icon: 'fa-solid fa-flag' },
                { name: 'Opinion & Analysis', desc: 'Expert commentary, editorials, and analytical pieces on African development', icon: 'fa-solid fa-pen-fancy' }
            ]
        },
        press: {
            title: 'Press Releases',
            description: 'Official communications and media resources from the African Union Commission.',
            items: [
                { name: 'Official Statements', desc: 'Formal statements from the AU Chairperson and Commission leadership', icon: 'fa-solid fa-bullhorn' },
                { name: 'Media Advisories', desc: 'Advance notice of upcoming events, briefings, and media opportunities', icon: 'fa-solid fa-bell' },
                { name: 'Press Kits', desc: 'Downloadable media kits with facts, figures, logos, and key messages', icon: 'fa-solid fa-folder-open' },
                { name: 'Spokesperson Briefings', desc: 'Regular briefings from the AU spokesperson on current affairs and decisions', icon: 'fa-solid fa-microphone' },
                { name: 'Media Accreditation', desc: 'Information for journalists on accreditation for AU summits and events', icon: 'fa-solid fa-id-badge' }
            ]
        },
        events: {
            title: 'Upcoming Events',
            description: 'Calendar of AU summits, conferences, workshops, and engagement opportunities across Africa.',
            items: [
                { name: 'AU Assembly Sessions', desc: 'Biannual ordinary sessions of the Assembly of Heads of State and Government', icon: 'fa-solid fa-calendar-days' },
                { name: 'Regional Conferences', desc: 'REC-organized conferences on trade, security, health, and development', icon: 'fa-solid fa-users-rectangle' },
                { name: 'Workshops & Training', desc: 'Capacity building workshops for government officials and stakeholders', icon: 'fa-solid fa-chalkboard-user' },
                { name: 'Webinars & Virtual Events', desc: 'Online seminars and discussions on key thematic areas and policy issues', icon: 'fa-solid fa-desktop' },
                { name: 'Calendar of Events', desc: 'Full yearly calendar of all scheduled AU and Agenda 2063-related events', icon: 'fa-solid fa-calendar' }
            ]
        },
        conferences: {
            title: 'Conferences',
            description: 'Major AU and partner-organized conferences driving Africa\'s development discourse.',
            items: [
                { name: 'AU Summit', desc: 'The flagship biannual summit bringing together all African Heads of State', icon: 'fa-solid fa-building-columns' },
                { name: 'Ministerial Conferences', desc: 'Sector-specific ministerial meetings on trade, health, education, and defense', icon: 'fa-solid fa-briefcase' },
                { name: 'Africa-Partner Summits', desc: 'Summits with EU, China, Japan, US, and other international partners', icon: 'fa-solid fa-handshake-angle' },
                { name: 'Youth & Women Forums', desc: 'Dedicated forums for youth engagement and women\'s leadership in development', icon: 'fa-solid fa-venus-mars' },
                { name: 'Conference Archives', desc: 'Proceedings, resolutions, and outcomes from past conferences and summits', icon: 'fa-solid fa-box-archive' }
            ]
        },
        media: {
            title: 'Media Gallery',
            description: 'Visual and multimedia resources showcasing Agenda 2063 initiatives and impact across Africa.',
            items: [
                { name: 'Photo Gallery', desc: 'High-resolution images from AU summits, projects, and continental events', icon: 'fa-solid fa-images' },
                { name: 'Video Library', desc: 'Documentaries, interviews, and event recordings on Agenda 2063 progress', icon: 'fa-solid fa-video' },
                { name: 'Infographics', desc: 'Visual data representations of key statistics, goals, and achievements', icon: 'fa-solid fa-chart-simple' },
                { name: 'Podcasts & Audio', desc: 'Audio series featuring discussions with AU leaders and development experts', icon: 'fa-solid fa-podcast' },
                { name: 'Social Media Hub', desc: 'Curated content from AU social media channels across all platforms', icon: 'fa-solid fa-share-nodes' }
            ]
        },
        archive: {
            title: 'Archive',
            description: 'Historical records, documents, and resources from past initiatives and events.',
            items: [
                { name: 'Historical Documents', desc: 'Founding charters, treaties, and declarations from the OAU and AU era', icon: 'fa-solid fa-scroll' },
                { name: 'Past Events Archive', desc: 'Records and proceedings from completed summits, conferences, and workshops', icon: 'fa-solid fa-clock-rotate-left' },
                { name: 'Legacy Projects', desc: 'Documentation of completed projects and their outcomes and lessons learned', icon: 'fa-solid fa-monument' },
                { name: 'Digital Archive', desc: 'Digitized historical materials, speeches, and photographs for research', icon: 'fa-solid fa-hard-drive' },
                { name: 'Research Materials', desc: 'Academic papers, dissertations, and studies on AU history and Pan-Africanism', icon: 'fa-solid fa-graduation-cap' }
            ]
        },

        interviews: {
            title: 'Interviews',
            description: 'Exclusive interviews with AU leaders, heads of state, and development experts.',
            items: [
                { name: 'Leadership Interviews', desc: 'Conversations with AU Commission chairpersons and senior officials', icon: 'fa-solid fa-microphone-lines' },
                { name: 'Heads of State', desc: 'Interviews with African presidents and prime ministers on Agenda 2063 progress', icon: 'fa-solid fa-user-tie' },
                { name: 'Expert Insights', desc: 'Dialogues with economists, scientists, and policy experts on Africa\'s future', icon: 'fa-solid fa-brain' },
                { name: 'Youth Voices', desc: 'Interviews featuring young African leaders, innovators, and changemakers', icon: 'fa-solid fa-user-graduate' },
                { name: 'Diaspora Perspectives', desc: 'Views from African diaspora communities on continental development', icon: 'fa-solid fa-globe' }
            ]
        },
        newsletters: {
            title: 'Newsletters',
            description: 'Regular email newsletters keeping stakeholders informed on Agenda 2063 developments.',
            items: [
                { name: 'Monthly Digest', desc: 'Monthly round-up of key Agenda 2063 developments, events, and milestones', icon: 'fa-solid fa-envelope-open-text' },
                { name: 'Weekly Updates', desc: 'Brief weekly updates on AU activities and continental developments', icon: 'fa-solid fa-envelope' },
                { name: 'Thematic Bulletins', desc: 'Sector-specific bulletins on trade, health, education, peace, and governance', icon: 'fa-solid fa-newspaper' },
                { name: 'Subscribe', desc: 'Sign up to receive newsletters directly in your inbox', icon: 'fa-solid fa-bell' },
                { name: 'Newsletter Archive', desc: 'Browse all past newsletter editions organized by date and topic', icon: 'fa-solid fa-box-archive' }
            ]
        },
        blogs: {
            title: 'Blogs & Opinion',
            description: 'Thought-provoking blogs, op-eds, and commentary on African development issues.',
            items: [
                { name: 'Expert Blog', desc: 'Articles by AU policy experts and commissioned specialists on key topics', icon: 'fa-solid fa-pen-to-square' },
                { name: 'Guest Contributors', desc: 'Opinion pieces from external thought leaders, academics, and civil society', icon: 'fa-solid fa-user-pen' },
                { name: 'Youth Blog', desc: 'Platform for young Africans to share perspectives on development and governance', icon: 'fa-solid fa-feather-pointed' },
                { name: 'Data Stories', desc: 'Data-driven narratives explaining trends and developments across Africa', icon: 'fa-solid fa-chart-column' },
                { name: 'Submit Your Blog', desc: 'Guidelines for submitting articles and opinion pieces for publication', icon: 'fa-solid fa-paper-plane' }
            ]
        },
        webinars: {
            title: 'Webinars',
            description: 'Online seminars and discussions featuring AU experts and global development leaders.',
            items: [
                { name: 'Upcoming Webinars', desc: 'Register for scheduled webinars on Agenda 2063 thematic areas', icon: 'fa-solid fa-video' },
                { name: 'On-Demand Replays', desc: 'Watch recorded webinars at your convenience with full presentations', icon: 'fa-solid fa-play-circle' },
                { name: 'Panel Discussions', desc: 'Multi-speaker panels debating key issues in African development', icon: 'fa-solid fa-users-rectangle' },
                { name: 'Capacity Building Series', desc: 'Educational webinar series on M&E, policy analysis, and implementation', icon: 'fa-solid fa-chalkboard-user' },
                { name: 'Host a Webinar', desc: 'Partner with AU to organize webinars on Agenda 2063 topics', icon: 'fa-solid fa-desktop' }
            ]
        },
        'event-calendar': {
            title: 'Event Calendar',
            description: 'Full calendar of AU summits, conferences, workshops, and partner events.',
            items: [
                { name: 'Monthly View', desc: 'Browse events month by month with filtering by theme and location', icon: 'fa-solid fa-calendar-days' },
                { name: 'AU Summit Schedule', desc: 'Dates and details for upcoming AU Assembly sessions and summits', icon: 'fa-solid fa-building-columns' },
                { name: 'Regional Events', desc: 'Events organized by RECs and member states across the continent', icon: 'fa-solid fa-map-pin' },
                { name: 'Partner Events', desc: 'Development partner-organized events related to Agenda 2063 themes', icon: 'fa-solid fa-handshake' },
                { name: 'Add to Calendar', desc: 'Export events to your personal Google, Outlook, or Apple calendar', icon: 'fa-solid fa-calendar-plus' }
            ]
        },
        'social-hub': {
            title: 'Social Media Hub',
            description: 'Curated social media feeds and digital engagement across all AU platforms.',
            items: [
                { name: 'X (Twitter) Feed', desc: 'Latest tweets from @_AfricanUnion and Agenda 2063 official accounts', icon: 'fa-brands fa-x-twitter' },
                { name: 'Facebook Updates', desc: 'Posts, videos, and community discussions from AU Facebook pages', icon: 'fa-brands fa-facebook' },
                { name: 'YouTube Channel', desc: 'Official AU video content including documentaries, speeches, and events', icon: 'fa-brands fa-youtube' },
                { name: 'Instagram Gallery', desc: 'Visual stories and photo highlights from across the continent', icon: 'fa-brands fa-instagram' },
                { name: 'Digital Campaigns', desc: 'Join hashtag campaigns and digital movements supporting Agenda 2063', icon: 'fa-solid fa-hashtag' }
            ]
        },

        // ===== KNOWLEDGE BASE MENU =====
        documents: {
            title: 'Documents',
            description: 'Official AU documents, treaties, protocols, and legal instruments governing continental affairs.',
            items: [
                { name: 'AU Constitutive Act', desc: 'The founding legal document establishing the African Union and its organs', icon: 'fa-solid fa-file-contract' },
                { name: 'Treaties & Protocols', desc: 'Continental treaties on trade, movement of persons, peace, and governance', icon: 'fa-solid fa-file-shield' },
                { name: 'Decisions & Declarations', desc: 'Assembly and Executive Council decisions and summit declarations', icon: 'fa-solid fa-stamp' },
                { name: 'Policy Documents', desc: 'Continental policy frameworks on key sectors and development priorities', icon: 'fa-solid fa-file-lines' },
                { name: 'Technical Papers', desc: 'Expert technical papers supporting policy formulation and implementation', icon: 'fa-solid fa-file-code' }
            ]
        },
        publications: {
            title: 'Publications',
            description: 'AU Commission publications, journals, newsletters, and special edition reports.',
            items: [
                { name: 'AU Journals', desc: 'Peer-reviewed journals on African integration, peace, governance, and development', icon: 'fa-solid fa-book' },
                { name: 'The Agenda Newsletter', desc: 'Monthly newsletter with updates on implementation progress and events', icon: 'fa-solid fa-envelope-open-text' },
                { name: 'Annual Publications', desc: 'Yearly flagship publications including the State of Africa report', icon: 'fa-solid fa-book-bookmark' },
                { name: 'Special Editions', desc: 'Thematic publications on topics like COVID-19 response, climate, and youth', icon: 'fa-solid fa-bookmark' },
                { name: 'E-Publications Portal', desc: 'Digital publications available for free download in multiple languages', icon: 'fa-solid fa-tablet-screen-button' }
            ]
        },
        research: {
            title: 'Research Papers',
            description: 'Academic and policy research advancing understanding of Africa\'s development challenges.',
            items: [
                { name: 'Academic Research', desc: 'University and think-tank research on African integration and development', icon: 'fa-solid fa-flask' },
                { name: 'Policy Research', desc: 'Evidence-based research informing AU policy decisions and frameworks', icon: 'fa-solid fa-magnifying-glass' },
                { name: 'Case Studies', desc: 'Detailed case studies from member states on implementation successes and challenges', icon: 'fa-solid fa-file-circle-check' },
                { name: 'Working Papers', desc: 'Discussion papers and concept notes on emerging issues and policy options', icon: 'fa-solid fa-file-pen' },
                { name: 'Research Partnerships', desc: 'Collaborative research programs with global universities and institutions', icon: 'fa-solid fa-microscope' }
            ]
        },
        policies: {
            title: 'Policy Briefs',
            description: 'Concise policy briefs providing analysis and recommendations for decision-makers.',
            items: [
                { name: 'Economic Policy Briefs', desc: 'Analysis of trade, industrialization, and economic transformation policies', icon: 'fa-solid fa-coins' },
                { name: 'Social Policy Briefs', desc: 'Briefs on health, education, social protection, and demographic dividend', icon: 'fa-solid fa-hand-holding-heart' },
                { name: 'Governance Briefs', desc: 'Policy analysis on democracy, human rights, rule of law, and elections', icon: 'fa-solid fa-landmark-dome' },
                { name: 'Peace & Security Briefs', desc: 'Analysis of conflict situations, peacekeeping, and security sector reform', icon: 'fa-solid fa-shield' },
                { name: 'Climate & Environment Briefs', desc: 'Policy recommendations on climate adaptation, green growth, and sustainability', icon: 'fa-solid fa-leaf' }
            ]
        },
        library: {
            title: 'Digital Library',
            description: 'The AU\'s comprehensive digital repository of knowledge resources and reference materials.',
            items: [
                { name: 'E-Books Collection', desc: 'Full-text digital books on African history, development, and Pan-Africanism', icon: 'fa-solid fa-book-open-reader' },
                { name: 'Digital Collections', desc: 'Curated collections on specific themes like women\'s rights, youth, and innovation', icon: 'fa-solid fa-layer-group' },
                { name: 'Multimedia Resources', desc: 'Video lectures, webinar recordings, and educational multimedia content', icon: 'fa-solid fa-photo-film' },
                { name: 'Reference Materials', desc: 'Encyclopedias, glossaries, and reference guides on AU terminology and structures', icon: 'fa-solid fa-circle-info' },
                { name: 'Search & Catalog', desc: 'Advanced search across the entire AU knowledge repository and partner databases', icon: 'fa-solid fa-search' }
            ]
        },
        tools: {
            title: 'Tools & Guides',
            description: 'Practical tools, templates, and implementation guides for stakeholders at all levels.',
            items: [
                { name: 'Implementation Toolkit', desc: 'Step-by-step toolkit for domesticating Agenda 2063 into national plans', icon: 'fa-solid fa-toolbox' },
                { name: 'M&E Guide', desc: 'Monitoring and evaluation handbook for tracking progress at all levels', icon: 'fa-solid fa-book-atlas' },
                { name: 'Report Templates', desc: 'Standardized templates for country, regional, and thematic reporting', icon: 'fa-solid fa-file-invoice' },
                { name: 'Training Materials', desc: 'E-learning modules and workshop materials for capacity building programs', icon: 'fa-solid fa-person-chalkboard' },
                { name: 'Communication Toolkit', desc: 'Branding guidelines, key messages, and advocacy materials for outreach', icon: 'fa-solid fa-bullhorn' }
            ]
        },

        datasets: {
            title: 'Open Datasets',
            description: 'Publicly accessible datasets for researchers, policymakers, and citizens.',
            items: [
                { name: 'Agenda 2063 Indicators Dataset', desc: 'Complete dataset of all 300+ indicators for all member states by year', icon: 'fa-solid fa-database' },
                { name: 'Economic Data', desc: 'GDP, trade volumes, FDI, and economic transformation data by country', icon: 'fa-solid fa-coins' },
                { name: 'Social Data', desc: 'Education, health, demographics, and human development datasets', icon: 'fa-solid fa-heart-pulse' },
                { name: 'Governance Data', desc: 'Electoral data, rule of law indices, and governance indicators', icon: 'fa-solid fa-landmark' },
                { name: 'API Access', desc: 'REST API for developers to integrate Agenda 2063 data into applications', icon: 'fa-solid fa-code' }
            ]
        },
        infographics: {
            title: 'Infographics',
            description: 'Visual data representations making complex information accessible and shareable.',
            items: [
                { name: 'Progress Infographics', desc: 'Visual summaries of continental progress on each aspiration and goal', icon: 'fa-solid fa-chart-pie' },
                { name: 'Country Snapshots', desc: 'Single-page visual country profiles with key data and achievements', icon: 'fa-solid fa-image' },
                { name: 'Thematic Visuals', desc: 'Infographics on trade, health, education, peace, and infrastructure', icon: 'fa-solid fa-palette' },
                { name: 'Timeline Graphics', desc: 'Visual timelines showing milestones and key events in Agenda 2063 history', icon: 'fa-solid fa-timeline' },
                { name: 'Download & Share', desc: 'High-resolution infographics for social media, presentations, and print', icon: 'fa-solid fa-share-from-square' }
            ]
        },
        'e-learning': {
            title: 'E-Learning',
            description: 'Online courses and training modules on Agenda 2063 and African development.',
            items: [
                { name: 'Introduction Course', desc: 'Free introductory course on Agenda 2063 framework, goals, and aspirations', icon: 'fa-solid fa-graduation-cap' },
                { name: 'M&E Training', desc: 'Monitoring and evaluation training for government officials and researchers', icon: 'fa-solid fa-chalkboard-user' },
                { name: 'Policy Analysis Course', desc: 'Learn policy analysis skills for Agenda 2063 implementation at national level', icon: 'fa-solid fa-magnifying-glass' },
                { name: 'Data Literacy', desc: 'Build data literacy skills for interpreting and using Agenda 2063 indicators', icon: 'fa-solid fa-chart-simple' },
                { name: 'Certificates', desc: 'Earn certificates upon completion of AU accredited e-learning programs', icon: 'fa-solid fa-certificate' }
            ]
        },
        'case-studies': {
            title: 'Case Studies',
            description: 'In-depth case studies documenting successful implementation across member states.',
            items: [
                { name: 'Country Case Studies', desc: 'Detailed analysis of how individual nations are implementing Agenda 2063', icon: 'fa-solid fa-file-circle-check' },
                { name: 'Sector Case Studies', desc: 'Deep dives into specific sectors: agriculture, energy, education, health', icon: 'fa-solid fa-industry' },
                { name: 'Best Practice Cases', desc: 'Documented best practices that can be replicated across the continent', icon: 'fa-solid fa-lightbulb' },
                { name: 'Challenge & Solution Cases', desc: 'How countries overcame implementation challenges with innovative solutions', icon: 'fa-solid fa-puzzle-piece' },
                { name: 'Submit a Case Study', desc: 'Guidelines for contributing case studies to the AU knowledge repository', icon: 'fa-solid fa-paper-plane' }
            ]
        },
        glossary: {
            title: 'Glossary & FAQ',
            description: 'Comprehensive glossary of terms and frequently asked questions about Agenda 2063.',
            items: [
                { name: 'Glossary of Terms', desc: 'Definitions of key terms, acronyms, and concepts used in Agenda 2063', icon: 'fa-solid fa-spell-check' },
                { name: 'General FAQ', desc: 'Answers to frequently asked questions about Agenda 2063 and the AU', icon: 'fa-solid fa-circle-question' },
                { name: 'Implementation FAQ', desc: 'Technical FAQs on domestication, reporting, and implementation processes', icon: 'fa-solid fa-wrench' },
                { name: 'Data & Indicators FAQ', desc: 'Questions about data sources, methodologies, and indicator definitions', icon: 'fa-solid fa-question' },
                { name: 'Acronym Directory', desc: 'Complete directory of AU and Agenda 2063 related acronyms and abbreviations', icon: 'fa-solid fa-a' }
            ]
        },
        multimedia: {
            title: 'Multimedia',
            description: 'Video, audio, and interactive multimedia resources for learning and engagement.',
            items: [
                { name: 'Documentary Films', desc: 'Full-length documentaries on Agenda 2063, African development, and Pan-Africanism', icon: 'fa-solid fa-film' },
                { name: 'Animated Explainers', desc: 'Short animated videos explaining key concepts in accessible formats', icon: 'fa-solid fa-play' },
                { name: 'Podcast Series', desc: 'Audio series featuring discussions with leaders, experts, and citizens', icon: 'fa-solid fa-podcast' },
                { name: 'Interactive Maps', desc: 'Explore Africa\'s progress through interactive geographic visualizations', icon: 'fa-solid fa-map-location-dot' },
                { name: 'Virtual Tours', desc: 'Virtual tours of AU headquarters, flagship project sites, and heritage locations', icon: 'fa-solid fa-vr-cardboard' }
            ]
        },

        // ===== FLAGSHIP PROJECTS MENU =====
        afcfta: {
            title: 'African Continental Free Trade Area (AfCFTA)',
            description: 'The world\'s largest free trade area by number of countries, creating a single market of 1.3 billion people.',
            items: [
                { name: 'About AfCFTA', desc: 'Creating a single continental market for goods and services with free movement', icon: 'fa-solid fa-store' },
                { name: 'Trade Protocols', desc: 'Protocols on trade in goods, services, investment, IP, and competition policy', icon: 'fa-solid fa-file-contract' },
                { name: 'Implementation Dashboard', desc: 'Real-time tracking of ratification status and trading commencement per country', icon: 'fa-solid fa-gauge' },
                { name: 'Economic Impact', desc: 'Projected $450B increase in intra-African trade and 30M lifted from poverty', icon: 'fa-solid fa-chart-line' },
                { name: 'AfCFTA Secretariat', desc: 'Based in Accra, Ghana - coordinating implementation across all member states', icon: 'fa-solid fa-building-flag' }
            ]
        },
        train: {
            title: 'Integrated High-Speed Train Network',
            description: 'A continental high-speed rail network connecting all African capitals and commercial centres.',
            items: [
                { name: 'Project Vision', desc: 'Connecting all African capitals and commercial centres via high-speed rail', icon: 'fa-solid fa-train' },
                { name: 'Route Network Plan', desc: 'Planned routes across North-South, East-West, and coastal corridors', icon: 'fa-solid fa-route' },
                { name: 'Infrastructure Development', desc: 'Current rail construction projects and modernization of existing networks', icon: 'fa-solid fa-helmet-safety' },
                { name: 'Investment Framework', desc: 'Public-private partnership model and financing strategies for the network', icon: 'fa-solid fa-money-bill-trend-up' },
                { name: 'Progress & Timeline', desc: 'Phase-by-phase implementation progress and projected completion milestones', icon: 'fa-solid fa-hourglass-half' }
            ]
        },
        commodities: {
            title: 'African Commodities Strategy',
            description: 'Transforming Africa from a raw material exporter to a continent that adds value and industrializes.',
            items: [
                { name: 'Strategy Overview', desc: 'Continental framework for value addition, beneficiation, and industrialization', icon: 'fa-solid fa-industry' },
                { name: 'Value Chain Development', desc: 'Building local processing capacity for minerals, agriculture, and energy', icon: 'fa-solid fa-link' },
                { name: 'African Mining Vision', desc: 'Transparent and equitable exploitation of mineral resources for development', icon: 'fa-solid fa-gem' },
                { name: 'Agricultural Transformation', desc: 'CAADP framework for modernizing agriculture and ensuring food security', icon: 'fa-solid fa-wheat-awn' },
                { name: 'Market Access & Trade', desc: 'Improving Africa\'s terms of trade and access to global commodity markets', icon: 'fa-solid fa-truck-fast' }
            ]
        },
        aviation: {
            title: 'Single African Air Transport Market (SAATM)',
            description: 'Liberalizing African aviation to create a unified air transport market across the continent.',
            items: [
                { name: 'SAATM Overview', desc: 'Implementing the Yamoussoukro Decision for open skies across Africa', icon: 'fa-solid fa-plane' },
                { name: 'Participating States', desc: '35 countries have signed, representing over 80% of intra-African air traffic', icon: 'fa-solid fa-globe-africa' },
                { name: 'Economic Benefits', desc: 'Projected 300,000+ new jobs and $4.2 billion in annual GDP contribution', icon: 'fa-solid fa-sack-dollar' },
                { name: 'Safety & Regulation', desc: 'Harmonized safety standards and regulatory frameworks across member states', icon: 'fa-solid fa-tower-control' },
                { name: 'Route Connectivity', desc: 'New direct routes connecting African cities, reducing travel time and costs', icon: 'fa-solid fa-plane-departure' }
            ]
        },
        passport: {
            title: 'African Passport & Free Movement',
            description: 'Enabling all African citizens to travel freely across the continent without visa restrictions.',
            items: [
                { name: 'African Passport Initiative', desc: 'A common passport for all African citizens to promote integration and mobility', icon: 'fa-solid fa-passport' },
                { name: 'Free Movement Protocol', desc: 'Protocol on free movement of persons, right of residence, and establishment', icon: 'fa-solid fa-person-walking-luggage' },
                { name: 'Visa Openness Index', desc: 'Annual ranking of African countries by visa openness and travel facilitation', icon: 'fa-solid fa-ranking-star' },
                { name: 'Implementation Progress', desc: 'Status of ratification, pilot programs, and rollout across member states', icon: 'fa-solid fa-spinner' },
                { name: 'Border Management', desc: 'Modernization of border posts and introduction of digital immigration systems', icon: 'fa-solid fa-border-all' }
            ]
        },
        university: {
            title: 'Pan-African University (PAU)',
            description: 'A premier continental university network with institutes across Africa\'s five regions.',
            items: [
                { name: 'About PAU', desc: 'Five thematic institutes in each African region offering masters and PhD programs', icon: 'fa-solid fa-university' },
                { name: 'Academic Programs', desc: 'Programs in water/energy, basic sciences, governance, earth/life sciences, and space', icon: 'fa-solid fa-graduation-cap' },
                { name: 'Research & Innovation', desc: 'Cutting-edge research addressing Africa\'s development challenges', icon: 'fa-solid fa-atom' },
                { name: 'Student Admissions', desc: 'Scholarship opportunities for African students with fully-funded programs', icon: 'fa-solid fa-user-graduate' },
                { name: 'Pan-African Virtual University', desc: 'Online learning platform expanding access to quality higher education', icon: 'fa-solid fa-laptop' }
            ]
        },

        'silencing-guns': {
            title: 'Silencing the Guns',
            description: 'AU flagship initiative to end all wars, civil conflicts, gender-based violence, and violent extremism by 2030.',
            items: [
                { name: 'Initiative Overview', desc: 'Comprehensive plan to achieve a conflict-free Africa through prevention and resolution', icon: 'fa-solid fa-ban' },
                { name: 'Master Roadmap', desc: 'Practical steps and milestones for achieving silence of all guns in Africa', icon: 'fa-solid fa-route' },
                { name: 'Country Commitments', desc: 'National commitments and action plans by member states to end conflicts', icon: 'fa-solid fa-handshake' },
                { name: 'Amnesty Month', desc: 'Annual Africa Amnesty Month for voluntary surrender of illegally held firearms', icon: 'fa-solid fa-calendar-check' },
                { name: 'Progress Tracker', desc: 'Monitoring conflicts, ceasefires, and peace agreements across the continent', icon: 'fa-solid fa-chart-line' }
            ]
        },
        'grand-museum': {
            title: 'Grand African Museum',
            description: 'A world-class museum in Algeria celebrating Africa\'s rich history, art, and cultural heritage.',
            items: [
                { name: 'Museum Vision', desc: 'Preserving and showcasing Africa\'s cultural heritage spanning thousands of years', icon: 'fa-solid fa-building' },
                { name: 'Collections & Exhibits', desc: 'Planned collections covering art, archaeology, history, and contemporary Africa', icon: 'fa-solid fa-palette' },
                { name: 'Architecture & Design', desc: 'State-of-the-art architectural design reflecting African artistic traditions', icon: 'fa-solid fa-compass-drafting' },
                { name: 'Cultural Repatriation', desc: 'Efforts to return African artifacts and cultural objects from foreign institutions', icon: 'fa-solid fa-rotate-left' },
                { name: 'Construction Progress', desc: 'Current status of construction and projected opening timeline', icon: 'fa-solid fa-helmet-safety' }
            ]
        },
        'cyber-security': {
            title: 'Continental Cyber Security',
            description: 'Building Africa\'s cyber security capacity to protect digital infrastructure and citizens online.',
            items: [
                { name: 'AU Convention on Cyber Security', desc: 'The Malabo Convention establishing Africa\'s cybersecurity and data protection framework', icon: 'fa-solid fa-shield-halved' },
                { name: 'National CERT Development', desc: 'Supporting member states in establishing Computer Emergency Response Teams', icon: 'fa-solid fa-server' },
                { name: 'Data Protection Framework', desc: 'Continental standards for personal data protection and digital privacy', icon: 'fa-solid fa-lock' },
                { name: 'Cyber Crime Strategy', desc: 'Pan-African strategy for combating cybercrime and online fraud', icon: 'fa-solid fa-user-shield' },
                { name: 'Digital Skills Training', desc: 'Capacity building programs for cybersecurity professionals across Africa', icon: 'fa-solid fa-laptop-code' }
            ]
        },
        'outer-space': {
            title: 'African Space Agency',
            description: 'Establishing a continental space agency to harness space science and technology for Africa\'s development.',
            items: [
                { name: 'African Space Agency', desc: 'Headquartered in Egypt, coordinating Africa\'s space programs and satellite operations', icon: 'fa-solid fa-satellite' },
                { name: 'African Space Policy', desc: 'Continental space policy and strategy for leveraging space technology', icon: 'fa-solid fa-file-contract' },
                { name: 'Earth Observation', desc: 'Using satellite data for agriculture, climate monitoring, and disaster management', icon: 'fa-solid fa-satellite-dish' },
                { name: 'National Space Programs', desc: 'Supporting member states in developing national space capabilities', icon: 'fa-solid fa-rocket' },
                { name: 'Space Education', desc: 'STEM education and scholarships in space science and aeronautical engineering', icon: 'fa-solid fa-user-astronaut' }
            ]
        },
        'financial-institutions': {
            title: 'Continental Financial Institutions',
            description: 'Three flagship financial institutions to drive economic integration and monetary cooperation.',
            items: [
                { name: 'African Central Bank', desc: 'Continental central bank to manage a future single African currency', icon: 'fa-solid fa-building-columns' },
                { name: 'African Monetary Fund', desc: 'Providing balance of payments support and financial stability for member states', icon: 'fa-solid fa-sack-dollar' },
                { name: 'African Investment Bank', desc: 'Financing major infrastructure and development projects across the continent', icon: 'fa-solid fa-money-bill-trend-up' },
                { name: 'Implementation Status', desc: 'Progress on establishing each institution with ratification and capitalization updates', icon: 'fa-solid fa-spinner' },
                { name: 'Financial Integration Roadmap', desc: 'Phased approach to continental financial integration and monetary union', icon: 'fa-solid fa-road' }
            ]
        },
        'e-network': {
            title: 'Pan-African E-Network',
            description: 'A continental ICT infrastructure connecting Africa through broadband and digital services.',
            items: [
                { name: 'Project Overview', desc: 'Pan-African E-Network for tele-education, telemedicine, and e-governance', icon: 'fa-solid fa-network-wired' },
                { name: 'Broadband Infrastructure', desc: 'Fibre optic and satellite networks connecting African nations digitally', icon: 'fa-solid fa-wifi' },
                { name: 'Tele-Education', desc: 'Connecting African universities with global institutions for distance learning', icon: 'fa-solid fa-laptop' },
                { name: 'Telemedicine Services', desc: 'Remote healthcare consultations linking rural clinics to specialist hospitals', icon: 'fa-solid fa-stethoscope' },
                { name: 'Digital Governance', desc: 'E-governance solutions for efficient public service delivery across Africa', icon: 'fa-solid fa-display' }
            ]
        },

        // ===== CONTINENTAL FRAMEWORKS MENU =====
        governance: {
            title: 'Governance Framework',
            description: 'Strengthening democratic governance, rule of law, and human rights across the continent.',
            items: [
                { name: 'African Governance Architecture', desc: 'Continental framework for promoting good governance and democratic values', icon: 'fa-solid fa-landmark-dome' },
                { name: 'African Charter on Democracy', desc: 'Binding charter on elections, governance, and democratic transitions', icon: 'fa-solid fa-scroll' },
                { name: 'African Peer Review Mechanism', desc: 'Voluntary self-assessment mechanism for governance and economic management', icon: 'fa-solid fa-clipboard-question' },
                { name: 'Anti-Corruption Framework', desc: 'AU Convention on Preventing and Combating Corruption across member states', icon: 'fa-solid fa-gavel' },
                { name: 'African Court & Human Rights', desc: 'Continental judicial and human rights institutions protecting citizen rights', icon: 'fa-solid fa-scale-balanced' }
            ]
        },
        economic: {
            title: 'Economic Integration',
            description: 'Building a unified continental economy through trade, investment, and financial integration.',
            items: [
                { name: 'Regional Economic Integration', desc: 'Progressive integration through RECs toward a Continental Economic Community', icon: 'fa-solid fa-puzzle-piece' },
                { name: 'AfCFTA & Trade Facilitation', desc: 'Free trade area implementation with customs harmonization and trade protocols', icon: 'fa-solid fa-truck-ramp-box' },
                { name: 'African Investment Framework', desc: 'Pan-African Investment Code promoting cross-border investment and FDI', icon: 'fa-solid fa-hand-holding-dollar' },
                { name: 'Financial Integration', desc: 'African Central Bank, Monetary Fund, and Investment Bank establishment plans', icon: 'fa-solid fa-building-columns' },
                { name: 'Industrialization Strategy', desc: 'AIDA framework for accelerated industrial development across the continent', icon: 'fa-solid fa-gears' }
            ]
        },
        peace: {
            title: 'Peace & Security',
            description: 'The African Peace and Security Architecture (APSA) for conflict prevention and resolution.',
            items: [
                { name: 'Peace & Security Council', desc: 'AU\'s standing decision-making organ for conflict prevention and peacebuilding', icon: 'fa-solid fa-dove' },
                { name: 'African Standby Force', desc: 'Continental rapid-deployment military force for peacekeeping and intervention', icon: 'fa-solid fa-shield-halved' },
                { name: 'Continental Early Warning System', desc: 'Early warning mechanism for conflict prevention and crisis anticipation', icon: 'fa-solid fa-tower-broadcast' },
                { name: 'Silencing the Guns Initiative', desc: 'Flagship initiative to end all wars, civil conflicts, and violence by 2030', icon: 'fa-solid fa-ban' },
                { name: 'Post-Conflict Reconstruction', desc: 'Framework for rebuilding societies after conflict including DDR programs', icon: 'fa-solid fa-hammer' }
            ]
        },
        social: {
            title: 'Social Development',
            description: 'Frameworks for inclusive social development, human capital, and demographic dividend.',
            items: [
                { name: 'Continental Education Strategy', desc: 'CESA 2016-2025 framework for quality education and skills development', icon: 'fa-solid fa-school' },
                { name: 'Africa Health Strategy', desc: 'Continental health strategy including Africa CDC and universal health coverage', icon: 'fa-solid fa-hospital' },
                { name: 'Social Protection Framework', desc: 'Continental framework for social safety nets, pensions, and social insurance', icon: 'fa-solid fa-umbrella' },
                { name: 'AU Youth Charter', desc: 'Framework for youth empowerment, participation, and entrepreneurship', icon: 'fa-solid fa-children' },
                { name: 'Gender Equality Strategy', desc: 'AU Strategy for Gender Equality and Women\'s Empowerment 2018-2028', icon: 'fa-solid fa-venus-double' }
            ]
        },
        environment: {
            title: 'Environment & Climate',
            description: 'Continental frameworks for climate action, environmental sustainability, and green growth.',
            items: [
                { name: 'African Climate Strategy', desc: 'Continent-wide climate action plan aligned with Paris Agreement commitments', icon: 'fa-solid fa-temperature-arrow-up' },
                { name: 'Great Green Wall Initiative', desc: '8,000km wall of trees across the Sahel to combat desertification and drought', icon: 'fa-solid fa-tree' },
                { name: 'Blue Economy Strategy', desc: 'Framework for sustainable ocean and aquatic resource management', icon: 'fa-solid fa-water' },
                { name: 'Renewable Energy Framework', desc: 'Africa Renewable Energy Initiative targeting 300GW of clean energy capacity', icon: 'fa-solid fa-solar-panel' },
                { name: 'Biodiversity Conservation', desc: 'Continental biodiversity strategy for protecting Africa\'s unique ecosystems', icon: 'fa-solid fa-paw' }
            ]
        },
        culture: {
            title: 'Culture & Heritage',
            description: 'Celebrating and preserving Africa\'s rich cultural diversity, languages, and heritage.',
            items: [
                { name: 'Charter for African Cultural Renaissance', desc: 'Framework for preserving cultural identity and promoting African arts', icon: 'fa-solid fa-masks-theater' },
                { name: 'African Languages', desc: 'Promotion of African languages in education, governance, and daily life', icon: 'fa-solid fa-language' },
                { name: 'Creative & Cultural Industries', desc: 'Supporting Africa\'s $4.2B creative economy in film, music, fashion, and art', icon: 'fa-solid fa-palette' },
                { name: 'World Heritage Sites', desc: 'Protecting and promoting Africa\'s 140+ UNESCO World Heritage sites', icon: 'fa-solid fa-monument' },
                { name: 'Sports & Recreation', desc: 'Continental sports framework including Africa Games and youth athletics', icon: 'fa-solid fa-futbol' }
            ]
        },
        infrastructure: {
            title: 'Infrastructure Development',
            description: 'Continental frameworks for transport, energy, and ICT infrastructure connecting Africa.',
            items: [
                { name: 'PIDA (Infrastructure Development)', desc: 'Programme for Infrastructure Development in Africa covering transport, energy, ICT, and water', icon: 'fa-solid fa-road' },
                { name: 'Energy & Power', desc: 'Continental frameworks for universal energy access and cross-border power pools', icon: 'fa-solid fa-bolt' },
                { name: 'Transport Corridors', desc: 'Trans-African highway network and continental transport corridor development', icon: 'fa-solid fa-truck-moving' },
                { name: 'ICT & Broadband', desc: 'Continental broadband infrastructure and digital connectivity frameworks', icon: 'fa-solid fa-tower-cell' },
                { name: 'Water & Sanitation', desc: 'Africa Water Vision 2025 and continental frameworks for WASH services', icon: 'fa-solid fa-droplet' }
            ]
        },
        digital: {
            title: 'Digital Transformation',
            description: 'Africa\'s digital transformation strategy for leveraging technology in governance and economy.',
            items: [
                { name: 'AU Digital Transformation Strategy', desc: 'Continental strategy for a digitally empowered and inclusive Africa by 2030', icon: 'fa-solid fa-microchip' },
                { name: 'Digital Identity', desc: 'Pan-African digital identity framework for inclusive digital services', icon: 'fa-solid fa-fingerprint' },
                { name: 'E-Commerce Framework', desc: 'Continental digital trade and e-commerce protocols under AfCFTA', icon: 'fa-solid fa-cart-shopping' },
                { name: 'AI & Emerging Tech', desc: 'Continental approach to artificial intelligence, blockchain, and emerging technologies', icon: 'fa-solid fa-robot' },
                { name: 'Digital Skills & Innovation', desc: 'Programs for digital literacy, coding academies, and innovation hubs', icon: 'fa-solid fa-laptop-code' }
            ]
        },
        'youth-framework': {
            title: 'Youth Framework',
            description: 'Continental frameworks empowering Africa\'s youth as drivers of development and innovation.',
            items: [
                { name: 'African Youth Charter', desc: 'Binding framework for youth rights, participation, and empowerment across the continent', icon: 'fa-solid fa-children' },
                { name: 'Demographic Dividend Roadmap', desc: 'Harnessing Africa\'s young population for economic growth and transformation', icon: 'fa-solid fa-arrow-up-right-dots' },
                { name: 'Youth Entrepreneurship', desc: 'Programs and funding for young entrepreneurs and startup ecosystems', icon: 'fa-solid fa-lightbulb' },
                { name: '1 Million by 2021 Initiative', desc: 'AU initiative creating opportunities in education, employment, entrepreneurship, and engagement', icon: 'fa-solid fa-users' },
                { name: 'AU Youth Envoy', desc: 'Role of the AU Youth Envoy in advocating for youth priorities at the highest levels', icon: 'fa-solid fa-bullhorn' }
            ]
        },
        gender: {
            title: 'Gender Equality',
            description: 'Continental strategies for achieving gender equality and women\'s empowerment across Africa.',
            items: [
                { name: 'AU Gender Strategy', desc: 'Strategy for Gender Equality and Women\'s Empowerment 2018-2028', icon: 'fa-solid fa-venus-double' },
                { name: 'Maputo Protocol', desc: 'Protocol on the Rights of Women in Africa ensuring legal protection and equality', icon: 'fa-solid fa-file-shield' },
                { name: 'Women in Leadership', desc: 'Frameworks promoting women\'s participation in politics, governance, and business', icon: 'fa-solid fa-user-tie' },
                { name: 'Gender-Based Violence', desc: 'Continental frameworks for preventing and responding to gender-based violence', icon: 'fa-solid fa-shield-heart' },
                { name: 'Economic Empowerment', desc: 'Programs for women\'s economic inclusion, entrepreneurship, and financial access', icon: 'fa-solid fa-hand-holding-dollar' }
            ]
        },
        health: {
            title: 'Health & Wellbeing',
            description: 'Continental health frameworks for universal healthcare access and pandemic preparedness.',
            items: [
                { name: 'Africa Health Strategy', desc: 'Continental health strategy for universal health coverage and disease control', icon: 'fa-solid fa-hospital' },
                { name: 'Africa CDC', desc: 'Africa Centres for Disease Control coordinating pandemic response and health security', icon: 'fa-solid fa-virus-slash' },
                { name: 'Pharmaceutical Manufacturing', desc: 'Continental strategy to produce 60% of Africa\'s vaccines and medicines locally', icon: 'fa-solid fa-pills' },
                { name: 'Mental Health Framework', desc: 'Addressing mental health across the continent with policy and service frameworks', icon: 'fa-solid fa-brain' },
                { name: 'Nutrition & Food Security', desc: 'Continental frameworks for ending hunger and ensuring nutritional wellbeing', icon: 'fa-solid fa-apple-whole' }
            ]
        },
        migration: {
            title: 'Migration & Mobility',
            description: 'Continental frameworks governing migration, refugee protection, and labour mobility.',
            items: [
                { name: 'Migration Policy Framework', desc: 'Revised AU Migration Policy Framework for Africa and Plan of Action 2018-2030', icon: 'fa-solid fa-person-walking-luggage' },
                { name: 'Free Movement Protocol', desc: 'Protocol on Free Movement of Persons, right of residence, and establishment', icon: 'fa-solid fa-passport' },
                { name: 'Refugee Protection', desc: 'Kampala Convention on internal displacement and continental refugee frameworks', icon: 'fa-solid fa-tent' },
                { name: 'Labour Mobility', desc: 'Frameworks for skills recognition, professional qualifications, and labour migration', icon: 'fa-solid fa-briefcase' },
                { name: 'Diaspora Engagement', desc: 'Strategies for engaging the African diaspora in continental development', icon: 'fa-solid fa-globe' }
            ]
        }
    };

    // Handle submenu interactions
    const submenuLinks = document.querySelectorAll('.submenu-grid a');
    
    submenuLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            
            const parentDropdown = link.closest('.mega-dropdown');
            parentDropdown.querySelectorAll('.submenu-grid a').forEach(l => l.classList.remove('active'));
            
            link.classList.add('active');
            
            const submenuKey = link.getAttribute('data-submenu');
            
            const secondColumn = parentDropdown.querySelector('.second-column');
            const data = menuData[submenuKey];
            
            if (data) {
                const submenuTitle = secondColumn.querySelector('.submenu-title');
                const submenuDetails = secondColumn.querySelector('.submenu-details');

                submenuTitle.textContent = data.title;

                if (data.description) {
                    submenuTitle.insertAdjacentHTML('afterend',
                        secondColumn.querySelector('.submenu-description')
                            ? ''
                            : ''
                    );
                    let descEl = secondColumn.querySelector('.submenu-description');
                    if (!descEl) {
                        descEl = document.createElement('p');
                        descEl.className = 'submenu-description';
                        submenuTitle.after(descEl);
                    }
                    descEl.textContent = data.description;
                }

                submenuDetails.innerHTML = data.items.map(item => {
                    if (typeof item === 'object') {
                        return `<li>
                            <a href="#">
                                <div class="submenu-item-content">
                                    <i class="${item.icon}"></i>
                                    <div class="submenu-item-text">
                                        <span class="submenu-item-name">${item.name}</span>
                                        <span class="submenu-item-desc">${item.desc}</span>
                                    </div>
                                </div>
                            </a>
                        </li>`;
                    }
                    return `<li><a href="#">${item}</a></li>`;
                }).join('');
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.main-nav')) {
            document.querySelectorAll('.mega-dropdown').forEach(dropdown => {
                dropdown.style.display = 'none';
            });
        }
    });

    // About Page Hero Background Rotation
    const pageHero = document.getElementById('pageHero');
    if (pageHero) {
        const heroBackgrounds = pageHero.querySelectorAll('.page-hero-bg');
        let currentBgIndex = 0;

        function rotateHeroBackground() {
            heroBackgrounds[currentBgIndex].classList.remove('active');
            currentBgIndex = (currentBgIndex + 1) % heroBackgrounds.length;
            heroBackgrounds[currentBgIndex].classList.add('active');
        }

        // Rotate background every 5 seconds
        setInterval(rotateHeroBackground, 5000);
    }

    // About Page Subscription Popup
    const subscriptionOverlay = document.getElementById('subscriptionOverlay');
    const closeSubscription = document.getElementById('closeSubscription');
    const subscriptionForm = document.getElementById('subscriptionForm');
    let subscriptionTimeout;
    let subscriptionShownCount = 0;
    let isSubscriptionFormSubmitted = false;

    // Function to show subscription popup
    function showSubscriptionPopup() {
        if (!isSubscriptionFormSubmitted && subscriptionShownCount < 10) {
            subscriptionOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
            subscriptionShownCount++;
        }
    }

    // Function to hide subscription popup
    function hideSubscriptionPopup() {
        subscriptionOverlay.classList.remove('show');
        document.body.style.overflow = 'auto';
        
        // Reset timer to show again after 5 seconds if not submitted
        if (!isSubscriptionFormSubmitted) {
            subscriptionTimeout = setTimeout(showSubscriptionPopup, 5000);
        }
    }

    // Show subscription popup on About page after 5 seconds
    if (window.location.pathname.includes('about.html')) {
        subscriptionTimeout = setTimeout(showSubscriptionPopup, 5000);
    }

    // Close subscription popup
    if (closeSubscription) {
        closeSubscription.addEventListener('click', hideSubscriptionPopup);
    }

    // Close on overlay background click
    if (subscriptionOverlay) {
        subscriptionOverlay.addEventListener('click', (e) => {
            if (e.target === subscriptionOverlay) {
                hideSubscriptionPopup();
            }
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && subscriptionOverlay && subscriptionOverlay.classList.contains('show')) {
            hideSubscriptionPopup();
        }
    });

    // Handle subscription form submission
    if (subscriptionForm) {
        subscriptionForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(subscriptionForm);
            const data = {
                email: formData.get('email'),
                name: formData.get('name'),
                country: formData.get('country'),
                interests: formData.getAll('interests')
            };
            
            console.log('Subscription Form Submitted:', data);
            
            // Mark as submitted
            isSubscriptionFormSubmitted = true;
            
            // Clear any pending timeouts
            clearTimeout(subscriptionTimeout);
            
            // Show success message
            alert('Thank you for subscribing! You will now receive exclusive updates on Agenda 2063 progress and opportunities.');
            
            // Reset form and close overlay
            subscriptionForm.reset();
            hideSubscriptionPopup();
            
            // Don't show popup again
            document.body.style.overflow = 'auto';
        });
    }

    // Timeline Modal Functionality
    const timelineItems = document.querySelectorAll('.timeline-item');
    const timelineModalOverlay = document.getElementById('timelineModalOverlay');
    const closeTimelineModal = document.getElementById('closeTimelineModal');
    const timelineModalHeader = document.getElementById('timelineModalHeader');
    const timelineModalBody = document.getElementById('timelineModalBody');

    // Timeline data for each period
    const timelineData = {
        '2013': {
            year: '2013',
            title: 'Agenda 2063 Adopted',
            description: 'The historic adoption of Agenda 2063 marked a turning point in Africa\'s development trajectory, setting a bold vision for the continent\'s transformation.',
            overview: 'In May 2013, during the Golden Jubilee celebrations of the Organization of African Unity (OAU) / African Union (AU), African Heads of State and Government signed the 50th Anniversary Solemn Declaration. This declaration marked the re-dedication of Africa towards the attainment of the Pan African Vision of an integrated, prosperous and peaceful Africa, driven by its own citizens and representing a dynamic force in the international arena.',
            achievements: [
                {
                    title: 'Vision Articulation',
                    description: 'Comprehensive vision document outlining Africa\'s aspirations for the next 50 years',
                    icon: 'fa-eye'
                },
                {
                    title: 'Continental Consensus',
                    description: 'All 54 African Union member states endorsed the transformative agenda',
                    icon: 'fa-handshake'
                },
                {
                    title: 'Strategic Framework',
                    description: 'Established 7 aspirations and 20 goals to guide Africa\'s development',
                    icon: 'fa-sitemap'
                },
                {
                    title: 'Implementation Roadmap',
                    description: 'Developed a 50-year implementation plan divided into five 10-year phases',
                    icon: 'fa-map'
                }
            ],
            stats: [
                { number: '54', label: 'Member States' },
                { number: '7', label: 'Aspirations' },
                { number: '20', label: 'Goals' },
                { number: '50', label: 'Year Vision' }
            ],
            challenges: [
                'Translating continental vision into national development plans',
                'Securing adequate financing for implementation',
                'Building institutional capacity for coordination and monitoring'
            ],
            priorities: [
                'Establishing governance structures for Agenda 2063 implementation',
                'Developing monitoring and evaluation frameworks',
                'Mobilizing resources and partnerships for flagship projects'
            ]
        },
        '2014-2023': {
            year: '2014-2023',
            title: 'First Ten-Year Implementation Plan',
            description: 'The inaugural decade focused on laying the foundation for Africa\'s transformation through flagship projects and institutional reforms.',
            overview: 'The First Ten-Year Implementation Plan (2014-2023) set the foundation for achieving Agenda 2063\'s vision. It prioritized structural economic transformation, science and technology innovation, people-centered development, environmental sustainability, peace and security, and finance and partnerships. This period saw the launch of major flagship projects including the African Continental Free Trade Area (AfCFTA), infrastructure development initiatives, and institutional reforms.',
            achievements: [
                {
                    title: 'AfCFTA Launch',
                    description: 'Successfully launched the African Continental Free Trade Area, creating the world\'s largest free trade zone',
                    icon: 'fa-store'
                },
                {
                    title: 'Infrastructure Progress',
                    description: 'Significant advancement in continental infrastructure projects including transport and energy networks',
                    icon: 'fa-road'
                },
                {
                    title: 'Peace & Security',
                    description: 'Strengthened African Peace and Security Architecture with improved conflict prevention mechanisms',
                    icon: 'fa-shield-halved'
                },
                {
                    title: 'Digital Transformation',
                    description: 'Expanded digital infrastructure and connectivity across the continent',
                    icon: 'fa-wifi'
                }
            ],
            stats: [
                { number: '44', label: 'AfCFTA Signatories' },
                { number: '65%', label: 'Infrastructure Growth' },
                { number: '1.3B', label: 'Market Size' },
                { number: '$3.4T', label: 'Combined GDP' }
            ],
            challenges: [
                'COVID-19 pandemic disrupted implementation timelines and economic growth',
                'Persistent conflicts in some regions affected peace and security goals',
                'Financing gaps for major infrastructure projects',
                'Climate change impacts on agriculture and food security'
            ],
            priorities: [
                'Accelerating AfCFTA implementation and intra-African trade',
                'Completing priority infrastructure corridors',
                'Strengthening health systems and pandemic preparedness',
                'Advancing industrialization and value addition'
            ]
        },
        '2024-2033': {
            year: '2024-2033',
            title: 'Second Ten-Year Implementation Plan',
            description: 'Building on the foundation of the first decade, this phase accelerates industrialization, integration, and sustainable development across Africa.',
            overview: 'The Second Ten-Year Implementation Plan (2024-2033) focuses on accelerating Africa\'s transformation through enhanced industrialization, deeper regional integration, and sustainable development. This phase emphasizes leveraging the AfCFTA for economic growth, advancing digital transformation, addressing climate change, and empowering youth and women. The plan incorporates lessons learned from the first decade and adapts to emerging global challenges and opportunities.',
            achievements: [
                {
                    title: 'AfCFTA Operationalization',
                    description: 'Full operationalization of AfCFTA with increased intra-African trade volumes',
                    icon: 'fa-chart-line'
                },
                {
                    title: 'Green Transition',
                    description: 'Major investments in renewable energy and climate-resilient infrastructure',
                    icon: 'fa-leaf'
                },
                {
                    title: 'Digital Economy',
                    description: 'Expansion of digital economy with improved connectivity and e-commerce platforms',
                    icon: 'fa-laptop'
                },
                {
                    title: 'Youth Empowerment',
                    description: 'Enhanced skills development and entrepreneurship programs for African youth',
                    icon: 'fa-users'
                }
            ],
            stats: [
                { number: '52%', label: 'Intra-African Trade Target' },
                { number: '100M', label: 'Jobs Created' },
                { number: '80%', label: 'Renewable Energy' },
                { number: '500M', label: 'Internet Users' }
            ],
            challenges: [
                'Accelerating industrialization in a competitive global environment',
                'Managing climate change impacts while pursuing economic growth',
                'Bridging digital divide between urban and rural areas',
                'Ensuring inclusive growth that benefits all segments of society'
            ],
            priorities: [
                'Scaling up manufacturing and value addition across sectors',
                'Implementing climate adaptation and mitigation strategies',
                'Expanding digital infrastructure to underserved areas',
                'Creating quality jobs for Africa\'s growing youth population',
                'Strengthening regional value chains and supply networks'
            ]
        },
        '2034-2043': {
            year: '2034-2043',
            title: 'Third Ten-Year Implementation Plan',
            description: 'Consolidating gains from previous decades and scaling successful initiatives to achieve deeper integration and prosperity.',
            overview: 'The Third Ten-Year Implementation Plan (2034-2043) focuses on consolidating the achievements of the first two decades and scaling up successful initiatives across the continent. This phase emphasizes deepening economic integration, achieving food security, advancing technological innovation, and strengthening democratic governance. The plan aims to position Africa as a major global economic player with competitive industries and robust institutions.',
            achievements: [
                {
                    title: 'Economic Integration',
                    description: 'Achieved seamless movement of goods, services, and people across African borders',
                    icon: 'fa-globe'
                },
                {
                    title: 'Food Security',
                    description: 'Attained food self-sufficiency through modern agriculture and value chains',
                    icon: 'fa-wheat-awn'
                },
                {
                    title: 'Innovation Hubs',
                    description: 'Established world-class innovation and technology centers across the continent',
                    icon: 'fa-lightbulb'
                },
                {
                    title: 'Governance Excellence',
                    description: 'Strengthened democratic institutions and rule of law across member states',
                    icon: 'fa-balance-scale'
                }
            ],
            stats: [
                { number: '75%', label: 'Intra-African Trade' },
                { number: '0%', label: 'Hunger Rate' },
                { number: '200+', label: 'Tech Hubs' },
                { number: '95%', label: 'Democratic States' }
            ],
            challenges: [
                'Maintaining momentum and political will for continued reforms',
                'Adapting to rapid technological changes and automation',
                'Managing urbanization and ensuring sustainable cities',
                'Addressing income inequality and ensuring inclusive prosperity'
            ],
            priorities: [
                'Completing continental infrastructure networks',
                'Achieving universal access to quality education and healthcare',
                'Promoting innovation and technology adoption in all sectors',
                'Strengthening continental institutions and governance frameworks',
                'Building resilient economies capable of withstanding global shocks'
            ]
        },
        '2044-2053': {
            year: '2044-2053',
            title: 'Fourth Ten-Year Implementation Plan',
            description: 'Advancing towards full realization of Agenda 2063 aspirations with focus on sustainability and global leadership.',
            overview: 'The Fourth Ten-Year Implementation Plan (2044-2053) represents the penultimate phase of Agenda 2063, focusing on advancing towards full realization of the continental vision. This decade emphasizes sustainability, global leadership, cultural renaissance, and ensuring that development benefits reach all Africans. The plan aims to position Africa as an influential global player while preserving its cultural identity and environmental heritage.',
            achievements: [
                {
                    title: 'Global Leadership',
                    description: 'Africa emerges as a major voice in global governance and decision-making',
                    icon: 'fa-flag'
                },
                {
                    title: 'Sustainable Development',
                    description: 'Achieved balance between economic growth and environmental conservation',
                    icon: 'fa-tree'
                },
                {
                    title: 'Cultural Renaissance',
                    description: 'Revitalized African languages, arts, and cultural industries',
                    icon: 'fa-masks-theater'
                },
                {
                    title: 'Universal Prosperity',
                    description: 'Significantly reduced poverty with improved living standards for all',
                    icon: 'fa-hand-holding-heart'
                }
            ],
            stats: [
                { number: '90%', label: 'Intra-African Trade' },
                { number: '<5%', label: 'Poverty Rate' },
                { number: '$10T', label: 'Combined GDP' },
                { number: '100%', label: 'Clean Energy' }
            ],
            challenges: [
                'Ensuring sustainability of achievements for future generations',
                'Managing demographic transitions and aging populations',
                'Preserving cultural identity in an increasingly globalized world',
                'Addressing emerging security threats and global challenges'
            ],
            priorities: [
                'Consolidating democratic gains and strengthening institutions',
                'Achieving universal access to modern infrastructure and services',
                'Promoting African languages, culture, and creative industries',
                'Building strategic partnerships while maintaining African agency',
                'Preparing for the final push towards the 2063 vision'
            ]
        },
        '2054-2063': {
            year: '2054-2063',
            title: 'Final Ten-Year Implementation Plan',
            description: 'The culminating decade focused on achieving the complete vision of a prosperous, integrated, and peaceful Africa.',
            overview: 'The Final Ten-Year Implementation Plan (2054-2063) represents the culmination of 50 years of transformative efforts. This decade focuses on achieving the complete vision of Agenda 2063: a prosperous Africa based on inclusive growth and sustainable development, an integrated continent politically united, an Africa of good governance, democracy and respect for human rights, a peaceful and secure Africa, an Africa with a strong cultural identity, and an Africa as a strong and influential global player.',
            achievements: [
                {
                    title: 'Complete Integration',
                    description: 'Achieved full political and economic integration with federal or confederate structures',
                    icon: 'fa-link'
                },
                {
                    title: 'Prosperity for All',
                    description: 'Eliminated extreme poverty with high living standards across the continent',
                    icon: 'fa-trophy'
                },
                {
                    title: 'Peace & Security',
                    description: 'Achieved lasting peace with effective conflict prevention and resolution mechanisms',
                    icon: 'fa-dove'
                },
                {
                    title: 'Global Powerhouse',
                    description: 'Africa recognized as a major global economic and political powerhouse',
                    icon: 'fa-crown'
                }
            ],
            stats: [
                { number: '100%', label: 'Integration Level' },
                { number: '0%', label: 'Extreme Poverty' },
                { number: '$20T', label: 'Combined GDP' },
                { number: '2.5B', label: 'Population' }
            ],
            challenges: [
                'Ensuring the sustainability and continuity of achievements beyond 2063',
                'Adapting to unforeseen global changes and emerging challenges',
                'Maintaining unity and solidarity among diverse member states',
                'Preparing the next generation to carry forward the African vision'
            ],
            priorities: [
                'Finalizing all flagship projects and continental initiatives',
                'Documenting lessons learned and best practices for future generations',
                'Celebrating achievements while identifying areas for continued improvement',
                'Developing the post-2063 vision and strategic framework',
                'Ensuring institutional memory and knowledge transfer'
            ]
        }
    };

    // Open timeline modal
    if (timelineItems.length > 0) {
        timelineItems.forEach(item => {
            item.addEventListener('click', () => {
                const period = item.getAttribute('data-period');
                const data = timelineData[period];
                
                if (data) {
                    // Populate modal header
                    timelineModalHeader.innerHTML = `
                        <span class="timeline-modal-year-badge">${data.year}</span>
                        <h2>${data.title}</h2>
                        <p>${data.description}</p>
                    `;
                    
                    // Populate modal body
                    let achievementsHTML = data.achievements.map(achievement => `
                        <div class="achievement-card">
                            <h4><i class="fa-solid ${achievement.icon}"></i> ${achievement.title}</h4>
                            <p>${achievement.description}</p>
                        </div>
                    `).join('');
                    
                    let statsHTML = data.stats.map(stat => `
                        <div class="stat-box">
                            <span class="stat-number">${stat.number}</span>
                            <span class="stat-label">${stat.label}</span>
                        </div>
                    `).join('');
                    
                    let challengesHTML = data.challenges.map(challenge => `
                        <li><i class="fa-solid fa-exclamation-triangle"></i> ${challenge}</li>
                    `).join('');
                    
                    let prioritiesHTML = data.priorities.map(priority => `
                        <li><i class="fa-solid fa-star"></i> ${priority}</li>
                    `).join('');
                    
                    timelineModalBody.innerHTML = `
                        <div class="timeline-modal-section">
                            <h3><i class="fa-solid fa-book-open"></i> Overview</h3>
                            <p>${data.overview}</p>
                        </div>
                        
                        <div class="timeline-modal-section">
                            <h3><i class="fa-solid fa-trophy"></i> Key Achievements</h3>
                            <div class="achievements-grid">
                                ${achievementsHTML}
                            </div>
                        </div>
                        
                        <div class="timeline-modal-section">
                            <h3><i class="fa-solid fa-chart-bar"></i> Key Statistics</h3>
                            <div class="stats-grid">
                                ${statsHTML}
                            </div>
                        </div>
                        
                        <div class="timeline-modal-section">
                            <h3><i class="fa-solid fa-exclamation-circle"></i> Challenges</h3>
                            <ul class="challenges-list">
                                ${challengesHTML}
                            </ul>
                        </div>
                        
                        <div class="timeline-modal-section">
                            <h3><i class="fa-solid fa-bullseye"></i> Strategic Priorities</h3>
                            <ul class="priorities-list">
                                ${prioritiesHTML}
                            </ul>
                        </div>
                    `;
                    
                    // Show modal
                    timelineModalOverlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            });
        });
    }

    // Close timeline modal
    function closeTimelineModalFunc() {
        timelineModalOverlay.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    if (closeTimelineModal) {
        closeTimelineModal.addEventListener('click', closeTimelineModalFunc);
    }

    // Close on overlay click
    if (timelineModalOverlay) {
        timelineModalOverlay.addEventListener('click', (e) => {
            if (e.target === timelineModalOverlay) {
                closeTimelineModalFunc();
            }
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && timelineModalOverlay && timelineModalOverlay.classList.contains('show')) {
            closeTimelineModalFunc();
        }
    });

    // ===== Footer Quiz Gamification (Rotating Questions) =====
    const footerQuizQuestions = [
        {
            question: 'In what year was Agenda 2063 adopted by African heads of state?',
            options: ['2010', '2013', '2015', '2020'],
            correct: 1
        },
        {
            question: 'How many aspirations does Agenda 2063 have?',
            options: ['5', '7', '10', '12'],
            correct: 1
        },
        {
            question: 'What is the largest free trade area in the world by member countries?',
            options: ['EU Single Market', 'USMCA', 'AfCFTA', 'ASEAN'],
            correct: 2
        },
        {
            question: 'Which flagship project aims to end all conflicts on the continent?',
            options: ['African Passport', 'Silencing the Guns', 'Pan-African E-Network', 'AfCFTA'],
            correct: 1
        },
        {
            question: 'What is the target year for Africa\'s complete transformation under Agenda 2063?',
            options: ['2050', '2055', '2063', '2075'],
            correct: 2
        },
        {
            question: 'How many 10-year implementation plans make up Agenda 2063?',
            options: ['3', '4', '5', '6'],
            correct: 2
        },
        {
            question: 'Which body is responsible for coordinating Agenda 2063?',
            options: ['United Nations', 'African Union', 'World Bank', 'ECOWAS'],
            correct: 1
        },
        {
            question: 'What does SAATM stand for in Agenda 2063 flagship projects?',
            options: [
                'South African Air Transport Market',
                'Single African Air Transport Market',
                'Strategic African Aviation & Trade Movement',
                'Southern Africa Air Travel Mission'
            ],
            correct: 1
        },
        {
            question: 'Which aspiration focuses on Africa being "people-driven"?',
            options: ['Aspiration 2', 'Aspiration 4', 'Aspiration 6', 'Aspiration 7'],
            correct: 2
        },
        {
            question: 'What percentage of Africa\'s population is under 25 years old?',
            options: ['About 40%', 'About 50%', 'About 60%', 'About 70%'],
            correct: 2
        }
    ];

    const fqSection = document.getElementById('footerQuizSection');
    const fqStartForm = document.getElementById('fqStartForm');
    const fqUserForm = document.getElementById('fqUserForm');
    const fqQuizContent = document.getElementById('fqQuizContent');
    const fqQuestion = document.getElementById('fqQuestion');
    const fqOptions = document.getElementById('fqOptions');
    const fqFeedback = document.getElementById('fqFeedback');
    const fqNextBtn = document.getElementById('fqNextBtn');
    const fqCurrent = document.getElementById('fqCurrent');
    const fqTotal = document.getElementById('fqTotal');
    const fqScoreEl = document.getElementById('fqScore');

    if (fqSection && fqStartForm) {
        let fqIndex = 0;
        let fqScoreCount = 0;
        let fqAnsweredCount = 0;
        let fqAutoTimer = null;
        const fqLetters = ['A', 'B', 'C', 'D'];

        // User info storage
        let fqUserInfo = { name: '', email: '', country: '' };

        // Check if user already filled in info (stored in localStorage)
        const savedFqUser = localStorage.getItem('agenda2063_fq_user');
        if (savedFqUser) {
            try {
                fqUserInfo = JSON.parse(savedFqUser);
                // Skip form, show quiz directly
                fqStartForm.style.display = 'none';
                fqQuizContent.style.display = 'block';
            } catch (e) {
                // Invalid data, show form
            }
        }

        // Shuffle questions for variety
        const shuffledFQ = [...footerQuizQuestions].sort(() => Math.random() - 0.5);

        fqTotal.textContent = shuffledFQ.length;

        // Handle start form submission
        fqUserForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const nameInput = document.getElementById('fqName');
            const emailInput = document.getElementById('fqEmail');
            const countryInput = document.getElementById('fqCountry');

            fqUserInfo.name = nameInput.value.trim();
            fqUserInfo.email = emailInput.value.trim();
            fqUserInfo.country = countryInput.value;

            // Save to localStorage
            localStorage.setItem('agenda2063_fq_user', JSON.stringify(fqUserInfo));

            // Hide form, show quiz
            fqStartForm.style.display = 'none';
            fqQuizContent.style.display = 'block';

            // Render first question
            renderFooterQuiz();
        });

        function renderFooterQuiz() {
            const q = shuffledFQ[fqIndex];
            fqCurrent.textContent = fqIndex + 1;
            fqQuestion.textContent = q.question;
            fqFeedback.style.display = 'none';
            fqNextBtn.disabled = true;

            fqOptions.innerHTML = '';
            q.options.forEach((opt, i) => {
                const el = document.createElement('div');
                el.className = 'fq-option';
                el.innerHTML = `<span class="fq-letter">${fqLetters[i]}</span><span>${opt}</span>`;
                el.addEventListener('click', () => handleFooterQuizAnswer(i));
                fqOptions.appendChild(el);
            });

            // Clear any existing auto-rotate timer
            clearTimeout(fqAutoTimer);
        }

        function handleFooterQuizAnswer(selected) {
            const q = shuffledFQ[fqIndex];
            const isCorrect = selected === q.correct;
            fqAnsweredCount++;
            if (isCorrect) fqScoreCount++;
            fqScoreEl.textContent = fqScoreCount;

            // Mark options
            const opts = fqOptions.querySelectorAll('.fq-option');
            opts.forEach((opt, i) => {
                opt.classList.add('fq-disabled');
                if (i === q.correct) opt.classList.add('fq-correct');
                if (i === selected && !isCorrect) opt.classList.add('fq-wrong');
            });

            // Show feedback
            fqFeedback.style.display = 'flex';
            if (isCorrect) {
                fqFeedback.className = 'fq-feedback fq-fb-correct';
                fqFeedback.innerHTML = '<i class="fa-solid fa-circle-check"></i> Correct! Well done!';
            } else {
                fqFeedback.className = 'fq-feedback fq-fb-wrong';
                fqFeedback.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Not quite! The answer is: ' + q.options[q.correct];
            }

            fqNextBtn.disabled = false;

            // Save answer to database via AJAX
            saveFooterQuizAnswer(q, selected, isCorrect);

            // Auto-advance after 4 seconds
            fqAutoTimer = setTimeout(() => {
                advanceFooterQuiz();
            }, 4000);
        }

        function saveFooterQuizAnswer(question, selectedIndex, isCorrect) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) return;

            fetch('/quiz/answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: JSON.stringify({
                    email: fqUserInfo.email,
                    name: fqUserInfo.name,
                    country: fqUserInfo.country,
                    quiz_type: 'footer',
                    slide_number: fqIndex + 1,
                    question: question.question,
                    selected_answer: question.options[selectedIndex],
                    is_correct: isCorrect
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Footer quiz answer saved:', data);
            })
            .catch(err => {
                console.error('Error saving footer quiz answer:', err);
            });
        }

        function advanceFooterQuiz() {
            clearTimeout(fqAutoTimer);
            fqIndex = (fqIndex + 1) % shuffledFQ.length;
            if (fqIndex === 0) {
                // Reset score after full cycle
                fqScoreCount = 0;
                fqAnsweredCount = 0;
                fqScoreEl.textContent = '0';
            }
            renderFooterQuiz();
        }

        fqNextBtn.addEventListener('click', advanceFooterQuiz);

        // Only render quiz immediately if user already filled in form
        if (savedFqUser) {
            renderFooterQuiz();
        }
    }

    // About Page Sidebar Active Link and Content Switching
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const contentBlocks = document.querySelectorAll('.content-block');
    const chairpersonCards = document.querySelectorAll('.chairperson-card');
    
    if (sidebarLinks.length > 0) {
        sidebarLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all links
                sidebarLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                
                // Get the target section ID
                const targetId = link.getAttribute('href').substring(1); // Remove the #
                
                // Hide all content blocks
                contentBlocks.forEach(block => {
                    block.classList.remove('active');
                });
                
                // Show the target content block
                const targetBlock = document.querySelector(`[data-section="${targetId}"]`);
                if (targetBlock) {
                    targetBlock.classList.add('active');
                }
                
                // Hide all chairperson cards
                chairpersonCards.forEach(card => {
                    card.style.display = 'none';
                });
                
                // Show the corresponding chairperson card
                const targetCard = document.querySelector(`[data-card="${targetId}"]`);
                if (targetCard) {
                    targetCard.style.display = 'block';
                }
                
                // Smooth scroll to top of content area
                const aboutContent = document.querySelector('.about-content');
                if (aboutContent) {
                    aboutContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }
});
