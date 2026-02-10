<!-- Campaign Overlay (Full Screen Modal) -->
<div class="campaign-overlay" id="campaignOverlay">
    <div class="campaign-content">
        <div class="campaign-left">
            <img src="https://agenda2063.africa/assets/Aspiration1.png" alt="Join Campaign" class="campaign-image">
            <div class="campaign-stats">
                <div class="stat-item">
                    <span class="stat-number">54</span>
                    <span class="stat-label">Member States</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1.3B+</span>
                    <span class="stat-label">Population</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">2063</span>
                    <span class="stat-label">Target Year</span>
                </div>
            </div>
        </div>
        <div class="campaign-right">
            <button class="close-campaign" id="closeCampaign">
                <i class="fa-solid fa-times"></i>
            </button>
            <h2>Join the Agenda 2063 Campaign</h2>
            <p class="campaign-subtitle">Be part of Africa's transformation. Together, we can build the Africa we want.</p>

            <!-- Success Message (hidden by default) -->
            <div class="campaign-success-message" id="campaignSuccess" style="display: none;">
                <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
                <h3>Welcome to the Movement!</h3>
                <p>Thank you for joining the Agenda 2063 Campaign. Together, we will build the Africa we want.</p>
            </div>

            <!-- Campaign Form -->
            <form class="campaign-form" id="campaignForm">
                @csrf
                <div class="campaign-form-errors" id="campaignErrors" style="display: none;"></div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name *</label>
                        <input type="text" id="firstName" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name *</label>
                        <input type="text" id="lastName" name="last_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="country">Country *</label>
                    <select id="country" name="country" required>
                        <option value="">Select your country</option>
                        <option value="algeria">Algeria</option>
                        <option value="angola">Angola</option>
                        <option value="benin">Benin</option>
                        <option value="botswana">Botswana</option>
                        <option value="burkina-faso">Burkina Faso</option>
                        <option value="cameroon">Cameroon</option>
                        <option value="egypt">Egypt</option>
                        <option value="ethiopia">Ethiopia</option>
                        <option value="ghana">Ghana</option>
                        <option value="kenya">Kenya</option>
                        <option value="morocco">Morocco</option>
                        <option value="nigeria">Nigeria</option>
                        <option value="rwanda">Rwanda</option>
                        <option value="senegal">Senegal</option>
                        <option value="south-africa">South Africa</option>
                        <option value="tanzania">Tanzania</option>
                        <option value="uganda">Uganda</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="interest">Area of Interest</label>
                    <select id="interest" name="interest">
                        <option value="">Select an area</option>
                        <option value="economic">Economic Development</option>
                        <option value="education">Education & Youth</option>
                        <option value="governance">Governance & Democracy</option>
                        <option value="peace">Peace & Security</option>
                        <option value="culture">Culture & Heritage</option>
                        <option value="environment">Environment & Climate</option>
                        <option value="technology">Technology & Innovation</option>
                    </select>
                </div>

                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="newsletter" id="newsletter">
                        <span>Subscribe to our newsletter for updates</span>
                    </label>
                </div>

                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" id="terms" required>
                        <span>I agree to the terms and conditions *</span>
                    </label>
                </div>

                <button type="submit" class="submit-btn" id="campaignSubmitBtn">
                    <i class="fa-solid fa-paper-plane"></i> Join the Campaign
                </button>
            </form>

            <div class="campaign-social">
                <p>Follow the campaign:</p>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

