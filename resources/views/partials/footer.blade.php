<!-- Footer Quiz Gamification Section -->
<section class="footer-quiz-section" id="footerQuizSection">
    <div class="footer-quiz-container">
        <div class="footer-quiz-left">
            <div class="footer-quiz-icon">
                <i class="fa-solid fa-brain"></i>
            </div>
            <div class="footer-quiz-intro">
                <h3>Test Your Knowledge</h3>
                <p>How well do you know Agenda 2063?</p>
            </div>
        </div>
        <div class="footer-quiz-right">
            <!-- Start Form: Collect user info before quiz -->
            <div class="fq-start-form" id="fqStartForm">
                <div class="fq-start-card">
                    <h4 class="fq-start-title"><i class="fa-solid fa-user-plus"></i> Join the Quiz</h4>
                    <p class="fq-start-desc">Enter your details to begin testing your knowledge</p>
                    <form id="fqUserForm">
                        <div class="fq-form-group">
                            <label for="fqName"><i class="fa-solid fa-user"></i> Full Name</label>
                            <input type="text" id="fqName" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="fq-form-group">
                            <label for="fqEmail"><i class="fa-solid fa-envelope"></i> Email Address</label>
                            <input type="email" id="fqEmail" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="fq-form-group">
                            <label for="fqCountry"><i class="fa-solid fa-globe-africa"></i> Country</label>
                            <select id="fqCountry" name="country" required>
                                <option value="">Select your country</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Angola">Angola</option>
                                <option value="Benin">Benin</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="DR Congo">DR Congo</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Egypt">Egypt</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Eswatini">Eswatini</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Mali">Mali</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Togo">Togo</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <button type="submit" class="fq-start-btn">
                            <i class="fa-solid fa-play"></i> Start Quiz
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quiz Content (hidden until form is submitted) -->
            <div class="fq-quiz-content" id="fqQuizContent" style="display: none;">
                <div class="footer-quiz-card" id="footerQuizCard">
                    <div class="fq-question" id="fqQuestion">Loading question...</div>
                    <div class="fq-options" id="fqOptions"></div>
                    <div class="fq-feedback" id="fqFeedback" style="display: none;"></div>
                </div>
                <div class="footer-quiz-nav">
                    <div class="fq-counter">
                        <span id="fqCurrent">1</span> / <span id="fqTotal">10</span>
                    </div>
                    <div class="fq-score-inline">
                        <i class="fa-solid fa-star"></i> <span id="fqScore">0</span> correct
                    </div>
                    <button class="fq-next-btn" id="fqNextBtn" disabled>
                        Next <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>About Agenda 2063</h4>
            <p>AGENDA 2063 is Africa's blueprint and master plan for transforming Africa into the global powerhouse of the future.</p>
            <div class="footer-contact">
                <strong>Information & Communication Directorate</strong>
            </div>
        </div>
        <div class="footer-column">
            <h4>Flagship Projects</h4>
            <ul>
                <li><a href="#">African Continental Free Trade Area (AfCFTA)</a></li>
                <li><a href="#">African Commodity Strategy</a></li>
                <li><a href="#">Single Africa Air Transport Market (SAATM)</a></li>
                <li><a href="#">Continental High-Speed Train Network</a></li>
                <li><a href="#">Pan-African E-Network</a></li>
                <li><a href="#">Cyber Security</a></li>
                <li><a href="#">Pan African Virtual and E-University (PAVEU)</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Aspirations</h4>
            <ul>
                <li><a href="#">A prosperous Africa based on inclusive growth and sustainable development</a></li>
                <li><a href="#">An integrated continent, politically united</a></li>
                <li><a href="#">An Africa of good governance, democracy, respect for human rights</a></li>
                <li><a href="#">A peaceful and secure Africa</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
                <li><a href="#">Member States</a></li>
                <li><a href="#">Resources</a></li>
                <li><a href="#">Download AU App</a></li>
                <li><a href="#">Get Involved</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <div class="footer-links">
            <a href="#">Contact Us</a>
            <a href="#">Cookie Policy</a>
            <a href="#">Privacy Notice</a>
            <a href="#">Site Terms</a>
        </div>
        <div class="copyright">
            Copyright &copy; Agenda 2063
        </div>
    </div>
</footer>
