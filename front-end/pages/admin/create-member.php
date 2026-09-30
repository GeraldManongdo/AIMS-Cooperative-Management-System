<?php

$pageTitle = 'Create New Member';
$pageName = "members";
ob_start();
?>

<!-- Page Header -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="/QTrace-Website/dashboard">Dashboard</a> </li>
            <li class="breadcrumb-item"><a href="/QTrace-Website/contractor-list">Contractor List</a></li>
            <li class="breadcrumb-item"><a href="/QTrace-Website/pages/admin/">Contractor Details</a></li>
            <li class="breadcrumb-item active">Edit Contractor</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-1">
        Create New Member
    </h4>

    <p class="text-muted mb-0">
        
    </p>

</div>


<!-- ================= Content ================= -->
<div class="row g-3 mb-4">
<form action="" method="POST" class="needs-validation" novalidate>

    <!-- Personal Information -->
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">
            
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-person me-2"></i>
                Personal Information
            </h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <!-- First Name -->
                <div class="col-12 col-md-4">
                    <label for="given_name" class="form-label">
                        First Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="given_name"
                        name="given_name"
                        placeholder="Enter first name"
                        minlength="2"
                        maxlength="50"
                        pattern="[A-Za-zÀ-ÿ\s'-]+"
                        required
                    >

                    <div class="invalid-feedback">
                        Please enter a valid first name.
                    </div>
                </div>


                <!-- Middle Name -->
                <div class="col-12 col-md-4">
                    <label for="middle_name" class="form-label">
                        Middle Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="middle_name"
                        name="middle_name"
                        placeholder="Enter middle name"
                        maxlength="50"
                        pattern="[A-Za-zÀ-ÿ\s'-]+"
                    >

                    <div class="invalid-feedback">
                        Please enter a valid middle name.
                    </div>
                </div>


                <!-- Last Name -->
                <div class="col-12 col-md-4">
                    <label for="last_name" class="form-label">
                        Last Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="last_name"
                        name="last_name"
                        placeholder="Enter last name"
                        minlength="2"
                        maxlength="50"
                        pattern="[A-Za-zÀ-ÿ\s'-]+"
                        required
                    >

                    <div class="invalid-feedback">
                        Please enter a valid last name.
                    </div>
                </div>


                <!-- Sex -->
                <div class="col-12 col-md-6">
                    <label for="sex" class="form-label">
                        Sex <span class="text-danger">*</span>
                    </label>

                    <select
                        class="form-select"
                        id="sex"
                        name="sex"
                        required
                    >
                        <option value="" selected disabled>
                            Select sex
                        </option>

                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <div class="invalid-feedback">
                        Please select a sex.
                    </div>
                </div>

                <!-- Date of Birth -->
                <div class="col-12 col-md-6">
                    <label for="date_of_birth" class="form-label">
                        Date of Birth <span class="text-danger">*</span>
                    </label>

                    <input
                        type="date"
                        class="form-control"
                        id="date_of_birth"
                        name="date_of_birth"
                        required
                    >

                    <div class="invalid-feedback">
                        Please select a date of birth.
                    </div>
                </div>

            </div>

        </div>
    </div>


    <!-- Contact Information -->
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-telephone me-2"></i>
                Contact Information
            </h5>

        </div>

        <div class="card-body">

            <div class="row g-3">

                <!-- Contact Number -->
                <div class="col-12 col-md-6">

                    <label for="contact_number" class="form-label">
                        Contact Number <span class="text-danger">*</span>
                    </label>

                    <input
                        type="tel"
                        class="form-control"
                        id="contact_number"
                        name="contact_number"
                        placeholder="09XXXXXXXXX"
                        pattern="09[0-9]{9}"
                        maxlength="11"
                        inputmode="numeric"
                        required
                    >

                    <div class="form-text">
                        Enter an 11-digit Philippine mobile number.
                    </div>

                    <div class="invalid-feedback">
                        Please enter a valid 11-digit mobile number.
                    </div>

                </div>


                <!-- Personal Email -->
                <div class="col-12 col-md-6">

                    <label for="personal_email" class="form-label">
                        Personal Email <span class="text-danger">*</span>
                    </label>

                    <div class="input-group has-validation">

                        <input
                            type="text"
                            class="form-control"
                            id="personal_email"
                            name="personal_email"
                            placeholder="example"
                            pattern="[a-zA-Z0-9._%+-]+"
                            maxlength="64"
                            required
                        >

                        <span class="input-group-text">
                            @gmail.com
                        </span>

                        <div class="invalid-feedback">
                            Please enter a valid Gmail username.
                        </div>

                    </div>

                    <div class="form-text">
                        Enter your Gmail username only.
                    </div>

                </div>


                <!-- Address -->
                <div class="col-12">

                    <label for="address" class="form-label">
                        Address <span class="text-danger">*</span>
                    </label>

                    <textarea
                        class="form-control"
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter complete address"
                        minlength="10"
                        maxlength="255"
                        required
                    ></textarea>

                    <div class="invalid-feedback">
                        Please enter a complete address.
                    </div>

                </div>

            </div>

        </div>
    </div>


    <!-- Form Actions -->
    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mb-4">

        <a
            href="members.php"
            class="btn btn-outline-secondary order-2 order-sm-1"
        >
            <i class="bi bi-x-lg me-1"></i>
            Cancel
        </a>

        <button
            type="submit"
            class="btn btn-primary order-1 order-sm-2"
        >
            <i class="bi bi-person-plus me-1"></i>
            Create Member
        </button>

    </div>

</form>


    <!-- Bootstrap Validation -->
    <script src="/Aims/front-end/assets/js/form-validator.js"></script>
</div>

<?php

$pageContent = ob_get_clean();

include __DIR__ . '/../../layouts/staff.php';