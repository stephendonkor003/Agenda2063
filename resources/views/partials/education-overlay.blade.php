<!-- Education/Gamification Overlay -->
<div class="education-overlay" id="educationOverlay">
    <div class="education-content">
        <!-- Left Panel: Visual + Progress -->
        <div class="education-left">
            <div class="edu-progress-section">
                <div class="edu-progress-bar">
                    <div class="edu-progress-fill" id="eduProgressFill" style="width: 0%"></div>
                </div>
                <span class="edu-progress-text" id="eduProgressText">0 / 11</span>
            </div>
            <div class="edu-slide-image" id="eduSlideImage">
                <img src="https://agenda2063.africa/assets/Aspiration1.png" alt="Slide Image" id="eduSlideImg">
            </div>
            <div class="edu-score-section">
                <div class="edu-score-badge" id="eduScoreBadge">
                    <i class="fa-solid fa-star"></i>
                    <span id="eduScoreValue">0</span> / <span id="eduScoreTotal">0</span>
                </div>
                <p class="edu-score-label">Your Score</p>
            </div>
            <div class="edu-slide-dots" id="eduSlideDots"></div>
        </div>

        <!-- Right Panel: Content + Quiz -->
        <div class="education-right">
            <button class="close-education" id="closeEducation">
                <i class="fa-solid fa-times"></i>
            </button>

            <div class="edu-slide-header">
                <span class="edu-slide-badge" id="eduSlideBadge">Aspiration 1</span>
                <h2 id="eduSlideTitle">A Prosperous Africa</h2>
                <p class="edu-slide-desc" id="eduSlideDesc">Description goes here</p>
            </div>

            <!-- Quiz Section -->
            <div class="edu-quiz-section" id="eduQuizSection">
                <h4 class="edu-quiz-question" id="eduQuizQuestion">Question goes here?</h4>
                <div class="edu-quiz-options" id="eduQuizOptions">
                    <!-- Options will be dynamically generated -->
                </div>
                <div class="edu-quiz-feedback" id="eduQuizFeedback" style="display: none;">
                    <div class="feedback-icon" id="feedbackIcon"></div>
                    <p id="feedbackMessage"></p>
                </div>
            </div>

            <!-- Navigation -->
            <div class="edu-navigation">
                <button class="edu-nav-btn edu-prev-btn" id="eduPrevBtn" disabled>
                    <i class="fa-solid fa-arrow-left"></i> Previous
                </button>
                <button class="edu-nav-btn edu-next-btn" id="eduNextBtn" disabled>
                    Next <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Completion Screen (hidden by default) -->
        <div class="edu-completion" id="eduCompletion" style="display: none;">
            <button class="close-education" id="closeEducationComplete">
                <i class="fa-solid fa-times"></i>
            </button>
            <div class="edu-completion-inner">
                <div class="edu-stars" id="eduStars"></div>
                <h2 id="completionTitle">Well Done!</h2>
                <p class="edu-completion-score" id="completionScore">You scored 0 out of 11</p>
                <p class="edu-completion-message" id="completionMessage">Great effort learning about Agenda 2063!</p>
                <div class="edu-completion-actions">
                    <button class="edu-retry-btn" id="eduRetryBtn">
                        <i class="fa-solid fa-rotate-right"></i> Try Again
                    </button>
                    <button class="edu-close-btn" id="eduCloseBtn">
                        <i class="fa-solid fa-check"></i> Done
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
