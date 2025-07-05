$(document).ready(function() {
    var categorySelect = $('select[name="category_id"]');
    var websiteTypeSelect = $('#websiteTypeSelect');
    var oldCategoryId = "{{ old('category_id') }}";
    var oldWebsiteType = "{{ old('website_type') }}";

    function loadWebsiteTypes(categoryId, selectedType = null) {
      websiteTypeSelect.html('<option value="">Loading...</option>');

      $.ajax({
        url: '/get-website-types/' + categoryId,
        type: 'GET',
        success: function(data) {
          websiteTypeSelect.empty().append('<option value="">Select Website Type</option>');
          if (data.length > 0) {
            $.each(data, function(key, type) {
              var selected = (selectedType && selectedType == type.id) ? 'selected' : '';
              websiteTypeSelect.append('<option value="' + type.id + '" ' + selected + '>' + type.type_title + '</option>');
            });
          } else {
            websiteTypeSelect.append('<option value="">No Website Types Found</option>');
          }
        },
        error: function() {
          websiteTypeSelect.html('<option value="">Error loading types</option>');
        }
      });
    }

    // On category change
    categorySelect.on('change', function() {
      var categoryId = $(this).val();
      if (categoryId) {
        loadWebsiteTypes(categoryId);
      } else {
        websiteTypeSelect.html('<option value="">Select Website Type</option>');
      }
    });

    // On initial load, if old category exists
    if (oldCategoryId) {
      loadWebsiteTypes(oldCategoryId, oldWebsiteType);
    }
  });