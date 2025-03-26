@extends('admin.layouts.admin')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Home Page Settings</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Home Page Settings</div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 mx-auto">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4>Home Page Setting</h4>
          <ul class="nav nav-tabs" id="homeTabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#talentPool">Talent Pool</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#retentionDetails">Retention Details</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pastWork">Past Work</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#operatedDomains">Operated Domains</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#testimonials">Testimonials</a></li>
          </ul>
        </div>

        <div class="card-body">
          <div class="tab-content mt-4">

            <!-- Talent Pool -->
            <div class="tab-pane fade show active" id="talentPool">
              <form action="{{ route('admin.home.talent-pool') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label>Numeric Talent</label>
                  <input type="number" name="numeric_talent" value="{{ $talentPool->numeric_talent ?? '' }}" class="form-control">
                </div>
                <div class="form-group">
                  <label>Pool Value</label>
                  <input type="text" name="pool_value" value="{{ $talentPool->pool_value ?? '' }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>

            <!-- Retention Details -->
            <div class="tab-pane fade" id="retentionDetails">
              <form action="{{ route('admin.home.retention') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label>Percentage Rate</label>
                  <input type="text" name="percentage_rate" value="{{ $retention->percentage_rate ?? '' }}" class="form-control">
                </div>
                <div class="form-group">
                  <label>Time Period</label>
                  <input type="text" name="time_period" value="{{ $retention->time_period ?? '' }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>

            <!-- Past Work -->
            <div class="tab-pane fade" id="pastWork">
              <button class="btn btn-primary mb-3 pastwork-btn">Add New Past Work</button>
              <table class="table table-bordered table-hover m-0">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>User Logo</th>
                    <th>Title</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pastwork as $work)
                  <tr>
                    <td>{{ $work->id }}</td>
                    <td><img src="{{ asset('storage/'.$work->user_logo) }}" width="50"></td>
                    <td>{{ $work->title }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm editPastWork" data-id="{{ $work->id }}">Edit</button>
                      <button class="btn btn-danger btn-sm ndelete-item" data-url="/admin/section/home/pastwork/{{ $work->id }}" data-tab="#pastWork">Delete</button>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @include('admin.modal.pastWorkModalPopup')
            </div>

            <!-- Operated Domains -->
            <div class="tab-pane fade" id="operatedDomains">
              <button class="btn btn-primary mb-3 domain-btn">Add New Domain</button>
              <table class="table table-bordered table-hover m-0">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Logo's</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($op_domain as $domain)
                  <tr>
                    <td>{{ $domain->id }}</td>
                    <td>{{ $domain->title }}</td>
                    <td>
                  @foreach(json_decode($domain->logos, true) as $logo)
                      <div class="position-relative d-inline-block me-2 mt-2">
                          <img src="{{ asset('storage/' . str_replace('public/', '', $logo)) }}" width="100" class="border rounded">
                          <button type="button" class="btn btn-danger btn-sm position-absolute deleteLogoBtn" 
                              data-logo="{{ $logo }}" 
                              data-id="{{ $domain->id }}"  
                              style="top: -8px; right: 5px; width: 22px; height: 22px; border-radius: 50%; padding: 0; font-size: 14px;">
                              &times;
                          </button>
                      </div>
                  @endforeach
                    </td>
                    <td>
                      <button class="btn btn-warning btn-sm editOperatedDomain" data-id="{{ $domain->id }}">Edit</button>
                      <button class="btn btn-danger btn-sm ndelete-item" data-url="/admin/section/home/operated_domains/{{ $domain->id }}" data-tab="#operatedDomains">Delete</button>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @include('admin.modal.operatedDomainModal')
            </div>

            <!-- Testimonials -->
            <div class="tab-pane fade" id="testimonials">
              <button class="btn btn-primary mb-3 testimonial-btn">Add Testimonial</button>
              <div class="table-responsive">
                <table class="table table-bordered table-hover m-0">
                  <thead class="thead-light">
                    <tr>
                      <th>ID</th>
                      <th>User Logo</th>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                      <td>{{ $testimonial->id }}</td>
                      <td><img src="{{ asset('storage/'.$testimonial->user_logo) }}" width="50"></td>
                      <td>{{ $testimonial->name }}</td>
                      <td>{{ $testimonial->position }}</td>
                      <td>
                        <button class="btn btn-warning btn-sm editTestimonial" data-id="{{ $testimonial->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm ndelete-item" data-url="/admin/section/home/testimonials/{{ $testimonial->id }}" data-tab="#testimonials">Delete</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @include('admin.modal.testimonialModal')
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function () {
    // Persist Active Tab
    const activeTab = localStorage.getItem("activeTab");
    if (activeTab) $('.nav-tabs a[href="' + activeTab + '"]').tab('show');

    $('.nav-tabs a').click(function () {
        localStorage.setItem("activeTab", $(this).attr("href"));
    });

    // File Upload Preview & Removal
    let selectedFiles = [];

    $("#logos").on("change", function (event) {
        const previewContainer = $("#logoPreviews");
        previewContainer.html(""); // Clear previous previews
        selectedFiles = Array.from(event.target.files);

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const previewDiv = $(`
                    <div class="position-relative d-inline-block me-2 mt-2" data-index="${index}">
                        <img src="${e.target.result}" width="100" class="border rounded">
                        <button type="button" class="btn btn-danger btn-sm position-absolute deleteLogoBtn"
                            style="top: -8px; right: 5px; width: 22px; height: 22px; border-radius: 50%; padding: 0; font-size: 14px;">
                            &times;
                        </button>
                    </div>
                `);
                previewDiv.find(".deleteLogoBtn").click(() => {
                    selectedFiles.splice(index, 1);
                    previewDiv.remove();
                    updateFileInput();
                });
                previewContainer.append(previewDiv);
            };
            reader.readAsDataURL(file);
        });

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            document.getElementById("logos").files = dataTransfer.files;
        }
    });

    // Handle Modals
    $(".testimonial-btn").click(() => $("#testimonialModalPopup").modal("show"));
    $(".pastwork-btn").click(() => $("#pastWorkModalPopup").modal("show"));
    $(".domain-btn").click(() => $("#domainModalPopup").modal("show"));

    // Submit Form with AJAX
    function submitForm(formId, url, tabName) {
        $(formId).submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = $(this).find(".itemId").val();
            if (id) formData.append("_method", "PUT");

            $.ajax({
                url: id ? `${url}/${id}` : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                success: function () {
                    localStorage.setItem("activeTab", tabName);
                    location.reload();
                },
                error: function (xhr) {
                    alert("Error: " + xhr.responseText);
                },
            });
        });
    }

    // Apply Forms
    submitForm("#testimonialForm", "/admin/section/home/testimonials", "#testimonials");
    submitForm("#pastWorkForm", "/admin/section/home/pastwork", "#pastWork");
    submitForm("#operatedDomainForm", "/admin/section/home/operated_domains", "#operatedDomains");

    // Edit Item Function
    function editItem(url, modalId, formFields) {
        $.get(url, function (response) {
            for (const [key, selector] of Object.entries(formFields)) {
                if (key === "logos") {
                    let logoPreviews = $(selector.preview);
                    logoPreviews.html("");

                    if (response[key]) {
                        let logos = JSON.parse(response[key]);
                        logos.forEach(logo => {
                            let imgSrc = `/storage/${logo.replace(/^storage\//, '')}`;
                            let previewDiv = $(`
                                <div class="position-relative d-inline-block me-2 mt-2">
                                    <img src="${imgSrc}" width="100" class="border rounded">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute deleteLogoBtn" data-logo="${logo}"
                                        style="top: -8px; right: 5px; width: 22px; height: 22px; border-radius: 50%; padding: 0; font-size: 14px;">
                                        &times;
                                    </button>
                                </div>
                            `);
                            logoPreviews.append(previewDiv);
                        });
                        $(selector.input).prop("required", false);
                    }
                } else if (key.includes("logo")) {
                    if (response[key]) {
                        $(selector.preview).show().attr("src", "/storage/" + response[key]);
                        $(selector.input).prop("required", false);
                    } else {
                        $(selector.preview).hide();
                        $(selector.input).prop("required", false);
                    }
                } else {
                    $(selector).val(response[key]);
                }
            }
            $(modalId).modal("show");
        });
    }

    // Edit Event Listeners
    $(document).on("click", ".editTestimonial", function () {
        let id = $(this).data("id");
        editItem(`/admin/section/home/testimonials/${id}/edit`, "#testimonialModalPopup", {
            id: "#testimonialId",
            name: "#name",
            position: "#position",
            testimonial_description: "#description",
            company_logo: { input: "#companyLogo", preview: "#companyLogoPreview" },
            user_logo: { input: "#userLogo", preview: "#userLogoPreview" },
        });
    });

    $(document).on("click", ".editPastWork", function () {
        let id = $(this).data("id");
        editItem(`/admin/section/home/pastwork/${id}/edit`, "#pastWorkModalPopup", {
            id: "#pastWorkId",
            title: "#pastWorkTitle",
            description: "#pastWorkDescription",
            company_logo: { input: "#pastWorkCompanyLogo", preview: "#pastWorkCompanyLogoPreview" },
            user_logo: { input: "#pastWorkUserLogo", preview: "#pastWorkUserLogoPreview" },
        });
    });

    $(document).on("click", ".editOperatedDomain", function () {
        let id = $(this).data("id");
        editItem(`/admin/section/home/operated_domains/${id}/edit`, "#domainModalPopup", {
            id: "#domainId",
            title: "#operatedDomainTitle",
            description: "#operatedDomainDescription",
            logos: { input: "#logos", preview: "#operatedDomainLogoPreviews" },
        });
    });

    // Delete Item Function
    function deleteItem(url, tabName = null) {
        if (confirm("Are you sure you want to delete this item?")) {
            $.ajax({
                url: url,
                type: "POST",
                data: { _method: "DELETE", _token: $('meta[name="csrf-token"]').attr("content") },
                success: function () {
                    if (tabName) localStorage.setItem("activeTab", tabName);
                    location.reload();
                },
                error: function (xhr) {
                    alert("Error: " + xhr.responseText);
                },
            });
        }
    }

    // Delete Logo from Database
    $(document).on("click", ".deleteLogoBtn", function () {
    let buttonDomainId = $(this).data("id");  // ID from button (table row)
    let formDomainId = $("#domainId").val();  // ID from hidden input (modal form)
    
    let operatedDomainId = buttonDomainId ? buttonDomainId : formDomainId; // Use button ID if available, fallback to form ID
    let logoToDelete = $(this).data("logo"); // Get the logo filename
    let logoElement = $(this).closest(".position-relative"); // Find the parent div

    if (!operatedDomainId) {
        logoElement.remove(); // If no ID (new entry), just remove from UI
        return;
    }

    if (!confirm("Are you sure you want to delete this logo?")) {
        return; // Stop if user cancels
    }

    $.ajax({
        url: `/admin/section/home/operated_domain/${operatedDomainId}/delete-logo`,
        type: "POST",
        data: { logo: logoToDelete },
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        success: function (response) {
            if (response.success) {
                logoElement.remove(); // Remove from UI after successful deletion
            } else {
                alert("Error: Unable to delete the logo.");
            }
        },
        error: function (xhr) {
            console.log("Error: " + xhr.responseText);
        },
    });
});


    $(".ndelete-item").click(function () {
        deleteItem($(this).data("url"), $(this).data("tab"));
    });
});

</script>
<!-- <script>
$(document).ready(function() {
  // Handle tab persistence
  let activeTab = localStorage.getItem("activeTab");
  if (activeTab) {
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }

  $('.nav-tabs a').click(function() {
    localStorage.setItem("activeTab", $(this).attr("href"));
  });

let selectedFiles = []; // Store selected files

document.getElementById('logos').addEventListener('change', function (event) {
    let previewContainer = document.getElementById('logoPreviews');
    previewContainer.innerHTML = ""; // Clear previous previews
    selectedFiles = Array.from(event.target.files); // Store new file selection

    selectedFiles.forEach((file, index) => {
        let reader = new FileReader();
        reader.onload = function (e) {
            let previewDiv = document.createElement('div');
            previewDiv.classList.add('position-relative', 'd-inline-block', 'me-2', 'mt-2');
            previewDiv.setAttribute('data-index', index);

            let img = document.createElement('img');
            img.src = e.target.result;
            img.width = 100;
            img.classList.add('border', 'rounded');

            let deleteBtn = document.createElement('button');
            deleteBtn.innerHTML = "&times;";
            deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute');
            deleteBtn.style.top = "-8px";
            deleteBtn.style.right = "5px";
            deleteBtn.style.width = "22px";
            deleteBtn.style.height = "22px";
            deleteBtn.style.borderRadius = "50%";
            deleteBtn.style.padding = "0";
            deleteBtn.style.fontSize = "14px";
            deleteBtn.style.display = "flex";
            deleteBtn.style.alignItems = "center";
            deleteBtn.style.justifyContent = "center";

            deleteBtn.addEventListener('click', function () {
                let indexToRemove = parseInt(previewDiv.getAttribute('data-index'));
                selectedFiles.splice(indexToRemove, 1); // Remove file from array
                previewDiv.remove();
                updateFileInput();
            });

            previewDiv.appendChild(img);
            previewDiv.appendChild(deleteBtn);
            previewContainer.appendChild(previewDiv);
        };
        reader.readAsDataURL(file);
    });

    function updateFileInput() {
        let dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('logos').files = dataTransfer.files;
    }
});


  // Show Testimonial Modal
  $('.testimonial-btn').click(() => $('#testimonialModalPopup').modal('show'));
  $('.pastwork-btn').click(() => $('#pastWorkModalPopup').modal('show'));
  $('.domain-btn').click(() => $('#domainModalPopup').modal('show'));

  function submitForm(formId, url, tabName) {
    $(formId).submit(function(e) {
      e.preventDefault();
      let id = $(this).find('.itemId').val(); // Hidden input field for ID
      let formData = new FormData(this);
      if (id) formData.append('_method', 'PUT');

      $.ajax({
        url: id ? `${url}/${id}` : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
          localStorage.setItem("activeTab", tabName);
          location.reload();
        },
        error: function(xhr) {
          alert("Error: " + xhr.responseText);
        }
      });
    });
  }

  // Apply to Testimonials
  submitForm('#testimonialForm', "/admin/section/home/testimonials", "#testimonials");

  // Apply to Past Work
  submitForm('#pastWorkForm', "/admin/section/home/pastwork", "#pastWork");

  // Apply to Operated Domain Work
  submitForm('#operatedDomainForm', "/admin/section/home/operated_domains", "#operatedDomains");

function editItem(url, modalId, formFields) {
    $.get(url, function(response) {
        // Loop through the form fields and set values dynamically
        for (const [key, selector] of Object.entries(formFields)) {
            if (key === "logos") {  
                // Handle multiple image previews
                let logoPreviews = $(selector.preview);
                logoPreviews.html(""); // Clear previous previews

                if (response[key]) {
                    let logos = JSON.parse(response[key]); // Convert JSON string to array
                    logos.forEach(logo => {
                        let imgSrc = "/storage/" + logo.replace(/^storage\//, ''); // Fix path issues
                        let previewDiv = $(`
                            <div class="position-relative d-inline-block me-2 mt-2">
                                <img src="${imgSrc}" width="100" class="border rounded">
                                <button type="button" class="btn btn-danger btn-sm position-absolute deleteLogoBtn" 
                                    data-logo="${logo}" style="top: -8px; right: 5px; width: 22px; height: 22px; border-radius: 50%; padding: 0; font-size: 14px;">
                                    &times;
                                </button>
                            </div>
                        `);
                        logoPreviews.append(previewDiv);
                    });
                    $(selector.input).prop("required", false);
                  }
            } else if (key.includes("logo")) {  
                // Handle single image previews
                if (response[key]) {
                    $(selector.preview).show().attr("src", "/storage/" + response[key]);
                    $(selector.input).prop("required", false);
                } else {
                    $(selector.preview).hide();
                    $(selector.input).prop("required", true);
                }
            } else {  
                // Handle text inputs
                $(selector).val(response[key]);
            }
        }

        $(modalId).modal("show"); // Show the modal
    });
}


  $(document).on("click", ".editTestimonial", function() {
    let id = $(this).data("id");
    editItem(`/admin/section/home/testimonials/${id}/edit`, "#testimonialModalPopup", {
      id: "#testimonialId",
      name: "#name",
      position: "#position",
      testimonial_description: "#description",
      company_logo: {
        input: "#companyLogo",
        preview: "#companyLogoPreview"
      },
      user_logo: {
        input: "#userLogo",
        preview: "#userLogoPreview"
      },
    });
  });

  $(document).on("click", ".editPastWork", function() {
    let id = $(this).data("id");
    editItem(`/admin/section/home/pastwork/${id}/edit`, "#pastWorkModalPopup", {
      id: "#pastWorkId",
      title: "#pastWorkTitle",
      description: "#pastWorkDescription",
      company_logo: {
        input: "#pastWorkCompanyLogo",
        preview: "#pastWorkCompanyLogoPreview"
      },
      user_logo: {
        input: "#pastWorkUserLogo",
        preview: "#pastWorkUserLogoPreview"
      },
    });
  });

  $(document).on("click", ".editOperatedDomain", function() {
    let id = $(this).data("id");
      editItem(`/admin/section/home/operated_domains/${id}/edit`, "#domainModalPopup", {
          id: "#domainId",
          title: "#operatedDomainTitle",
          description: "#operatedDomainDescription",
          logos: { input: "#logos", preview: "#operatedDomainLogoPreviews" }
      });
  });


  function deleteItem(url, tabName = null) {
    if (confirm("Are you sure you want to delete this item?")) {
      $.ajax({
        url: url,
        type: "POST",
        data: {
          _method: "DELETE",
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
          if (tabName) {
            localStorage.setItem("activeTab", tabName);
          }
          location.reload();
        },
        error: function(xhr) {
          alert("Error: " + xhr.responseText);
        }
      });
    }
  }

  $(document).on("click", ".domain-btn", function () {
      $("#operatedDomainForm")[0].reset(); // Reset form fields
      $("#operatedDomainLogoPreviews").html(""); // Clear logo previews
      $("#domainId").val(""); // Clear hidden ID input (if applicable)
      $("#operatedDomainModal").modal("show"); // Open modal
  });

  $("body").on("click", ".deleteLogoBtn", function () {
    let logoToDelete = $(this).data("logo"); // Get the logo filename
    let operatedDomainId = $("#domainId").val(); // Get the ID of the domain being edited
    let logoElement = $(this).closest(".position-relative"); // Find the parent div

    if (!operatedDomainId) {
        logoElement.remove(); // If adding a new entry, just remove from UI
        return;
    }

    $.ajax({
        url: `/admin/section/home/operated_domain/${operatedDomainId}/delete-logo`,
        type: "POST",
        data: { logo: logoToDelete },
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        success: function (response) {
            if (response.success) {
                logoElement.remove(); // Remove from UI after successful deletion
            } else {
                alert("Error: Unable to delete the logo.");
            }
        },
        error: function (xhr) {
            console.log("Error: " + xhr.responseText);
        },
    });
});


  $('.ndelete-item').click(function() {
    let url = $(this).data("url");
    let tab = $(this).data("tab") || null;
    deleteItem(url, tab);
  });

});
</script> -->
@endpush
