<?php include("includes/header.php") ?>
<main_estimate class="main_estimate animate-fade-in">
  <h2 class="animate-slide-in no-border">Cleaning Request Form</h2>
  <form action="submit_form.php" method="post" enctype="multipart/form-data" id="bookingForm">
    <!-- Contact Details -->
    <fieldset class="form-section">
      <legend>Contact Details</legend>
      <div class="row">
        <input type="text" name="first_name" placeholder="First Name" required />
        <input type="text" name="last_name" placeholder="Last Name" required />
      </div>
      <input type="text" name="company_name" placeholder="Company Name (Optional)" />
      <input type="email" name="email" placeholder="Email" required />
      <input type="tel" id="phone" name="phone" placeholder="+61XXXXXXXXX" required maxlength="13" />
    </fieldset>

    <!-- Address -->
    <fieldset class="form-section">
      <legend>Address</legend>
      <input type="text" name="street1" placeholder="Street 1" required />
      <input type="text" name="street2" placeholder="Street 2" />
      <select name="city" required>
        <option value="" disabled selected>Select City</option>
        <option value="Townsville">Townsville</option>
        <option value="Queensland">Queensland</option>
        <option value="Bay Areas">Bay Areas</option>
      </select>
    </fieldset>

    <!-- Cleaning Request -->
    <fieldset class="form-section">
      <legend>Cleaning Request</legend>
      <div class="checkbox-group">
        <?php
          $selected_service = isset($_GET['service']) ? $_GET['service'] : '';
          $services = [
            "Bond Cleaning",
            "Window Cleaning",
            "Spring Cleaning",
            "Builder Cleaning",
            "Exterior House Washing",
            "Oven and BBQ Cleaning"
          ];
          foreach ($services as $service) {
            $checked = ($selected_service === $service) ? 'checked' : '';
            echo '<label><input type="checkbox" name="services[]" value="' . $service . '" ' . $checked . '> ' . $service . '</label>';
          }
        ?>
      </div>
    </fieldset>

    <!-- Home Information -->
    <fieldset class="form-section home-info">
      <legend>Home Information</legend>
      <input type="number" name="bathrooms" placeholder="How many bathrooms are in your home?" min="0" required class="larger-text" />
      <input type="number" name="bedrooms" placeholder="How many bedrooms are in your home? (Optional)" min="0" class="larger-text" />
      <input type="text" name="last_cleaned" placeholder="When was the last time your home was professionally cleaned? (Optional)" class="larger-text" />

      <label style="margin-top: 15px; display: block; font-size: 1.1rem;">What days are you available for cleanings?</label>
      <div class="checkbox-group">
        <?php
          $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          foreach ($days as $day) {
            echo '<label><input type="checkbox" name="available_days[]" value="' . $day . '"> ' . $day . '</label>';
          }
        ?>
      </div>

      <!-- Combined preferred date and cleaner notes -->
      <label style="margin-top: 20px; display: block; font-size: 1.1rem;">
        Is there any preferred date and anything cleaners need to know?
      </label>
      <textarea name="notes_combined" placeholder="Write any preferred date and details for cleaners..." rows="4" style="width: 100%; padding: 12px; border-radius: 8px; margin-top: 10px;"></textarea>

      <!-- Upload -->
      <label style="margin-top: 20px; display: block; font-size: 1.1rem;">Upload images (Optional)<br><small>Share images of the work to be done</small></label>
      <input type="file" name="images[]" multiple accept="image/*" style="margin-top: 10px; border: 2px dashed #ccc; padding: 20px; border-radius: 10px; width: 100%; background-color: #f9f9f9;" />
      <p style="font-size: 0.9rem; color: #555; margin-top: 5px;">
        Do not upload files with payment information. Ensure you have all required rights, consent and permissions to share.
      </p>
    </fieldset>

    <!-- Submit -->
    <button type="submit" id="submitBtn">Get a Quote</button>
  </form>
</main_estimate>

<script>
  const phoneInput = document.getElementById('phone');
  phoneInput.value = "+61";
  phoneInput.addEventListener('input', function () {
    if (!this.value.startsWith("+61")) this.value = "+61";
    const digits = this.value.replace(/\D/g, '').substring(2, 11);
    this.value = "+61" + digits;
  });
  phoneInput.addEventListener('keydown', function (e) {
    if (this.selectionStart <= 3 && (e.key === "Backspace" || e.key === "Delete")) {
      e.preventDefault();
    }
  });
</script>
<style>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-in-left {
  from { opacity: 0; transform: translateX(-100px); }
  to { opacity: 1; transform: translateX(0); }
}

.animate-fade-in {
  animation: fade-in 0.6s ease-out forwards;
}

.animate-slide-in {
  animation: slide-in-left 1s ease-out forwards;
}

main_estimate {
  max-width: 85%;
  margin: 50px auto;
  padding: 30px;
  background-color: transparent;
  color: #111;
  font-family: 'Segoe UI', sans-serif;
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
}

main_estimate h2 {
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 35px;
  text-align: center;
  color: #111;
  border-bottom: none;
}

.form-section {
  margin-bottom: 30px;
}

.form-section legend {
  font-size: 1.3rem;
  font-weight: bold;
  margin-bottom: 15px;
  color: #000;
  padding: 0 10px;
}

.form-section input,
.form-section select,
.form-section textarea {
  width: 100%;
  padding: 14px 18px;
  font-size: 1.1rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin-top: 16px;
  box-sizing: border-box;
  font-family: inherit;
  transition: border-color 0.3s ease;
}

.form-section input:focus,
.form-section select:focus,
.form-section textarea:focus {
  border-color: #00b0f0;
  outline: none;
}

.form-section .row {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.form-section .row input {
  flex: 1 1 45%;
  min-width: 150px;
}

.home-info input,
.home-info label,
.home-info textarea {
  line-height: 1.8;
}

.checkbox-group {
  display: flex;
  flex-wrap: wrap;
  gap: 15px 30px;
  margin-top: 10px;
}

.checkbox-group label {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1.05rem;
  cursor: pointer;
  flex: 1 1 45%;
  min-width: 200px;
  user-select: none;
}

.checkbox-group input[type="checkbox"] {
  width: 18px;
  height: 18px;
  cursor: pointer;
  accent-color: #00b0f0;
}

button[type="submit"] {
  background-color: black;
  color: white;
  border: none;
  padding: 14px 25px;
  font-size: 1.1rem;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  align-self: flex-start;
  margin-top: 20px;
}

button[type="submit"]:hover {
  background-color: #00b0f0;
}

@media (max-width: 600px) {
  .form-section .row,
  .checkbox-group {
    flex-direction: column;
  }

  .form-section .row input,
  .checkbox-group label {
    flex: 1 1 100%;
    min-width: auto;
  }

  button[type="submit"] {
    width: 100%;
  }
}
</style>

<?php include("includes/footer.php") ?>
