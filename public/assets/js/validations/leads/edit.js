$(document).ready(function () {
  function loadWebsiteTypes(categoryId, selectedId = null) {
    var websiteTypeSelect = $('#websiteTypeSelect');
    websiteTypeSelect.html('<option value="">Loading...</option>');

    if (categoryId) {
      $.ajax({
        url: '/get-website-types/' + categoryId,
        type: 'GET',
        success: function (data) {
          websiteTypeSelect.empty().append('<option value="">Select Website Type</option>');
          $.each(data, function (key, type) {
            websiteTypeSelect.append(
              '<option value="' + type.id + '"' + (selectedId == type.id ? ' selected' : '') + '>' + type.type_title + '</option>'
            );
          });
        },
        error: function () {
          websiteTypeSelect.html('<option value="">Error loading types</option>');
        }
      });
    } else {
      websiteTypeSelect.html('<option value="">Select Website Type</option>');
    }
  }

  const initialCategoryId = $('#initialCategoryId').val();
  const selectedWebsiteTypeId = $('#selectedWebsiteTypeId').val();

  if (initialCategoryId) {
    loadWebsiteTypes(initialCategoryId, selectedWebsiteTypeId);
  }

  $('select[name="category_id"]').on('change', function () {
    loadWebsiteTypes($(this).val());
  });
});
