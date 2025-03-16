console.log("HIHIHIH");
document.querySelector('.needs-validation').addEventListener('submit', function (event) {
  if (!this.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }

  var phoneNumberInput = document.getElementById('inputNumber4');
  var phoneFeedback = document.getElementById('phoneFeedback');
  var phoneEmptyFeedback = document.getElementById('phoneEmptyFeedback');

  if (!phoneNumberInput.value) {
    // Nếu trống, hiển thị thông báo khi trống
    phoneNumberInput.classList.add('is-invalid');
    phoneFeedback.style.display = 'none';
    phoneEmptyFeedback.style.display = 'block';
  } else if (!isValidPhoneNumber(phoneNumberInput.value)) {
    // Nếu không hợp lệ, hiển thị thông báo khi nhập sai
    phoneNumberInput.classList.add('is-invalid');
    phoneEmptyFeedback.style.display = 'none';
    phoneFeedback.style.display = 'block';
  } else {
    // Nếu hợp lệ, ẩn thông báo và xóa lớp 'is-invalid'
    phoneNumberInput.classList.remove('is-invalid');
    phoneEmptyFeedback.style.display = 'none';
    phoneFeedback.style.display = 'none';
  }

  this.classList.add('was-validated');
});

// Kiểm tra số điện thoại hợp lệ (10 số)
function isValidPhoneNumber(phoneNumber) {
  var phoneRegex = /^[0-9]{10}$/;
  return phoneRegex.test(phoneNumber);
}

// Xử lý form validation
document.querySelector('.needs-validation').addEventListener('submit', function (event) {
  if (!this.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }

  var phoneNumberInput = document.getElementById('inputNumber4');
  var phoneFeedback = document.getElementById('phoneFeedback');
  var phoneEmptyFeedback = document.getElementById('phoneEmptyFeedback');

  if (!phoneNumberInput.value) {
    phoneNumberInput.classList.add('is-invalid');
    phoneFeedback.style.display = 'none';
    phoneEmptyFeedback.style.display = 'block';
  } else if (!isValidPhoneNumber(phoneNumberInput.value)) {
    phoneNumberInput.classList.add('is-invalid');
    phoneEmptyFeedback.style.display = 'none';
    phoneFeedback.style.display = 'block';
  } else {
    phoneNumberInput.classList.remove('is-invalid');
    phoneEmptyFeedback.style.display = 'none';
    phoneFeedback.style.display = 'none';
  }

  this.classList.add('was-validated');
});

// Load dữ liệu tỉnh/thành phố - quận/huyện từ JSON
var citySelect = document.getElementById("city");
var districtSelect = document.getElementById("district");

// Đường dẫn JSON đúng
var jsonURL = "http://localhost/BookVerse/public/json/vietnam_administrative_data.json";

// Kiểm tra xem Axios có tồn tại không
if (typeof axios === 'undefined') {
  console.error("Axios chưa được tải. Hãy thêm thư viện axios.min.js trước khi gọi.");
} else {
  // Gửi yêu cầu tải JSON
  axios.get(jsonURL)
    .then(function (response) {
      console.log("Dữ liệu JSON tải thành công:", response.data);
      renderCity(response.data);
    })
    .catch(function (error) {
      console.error("Lỗi khi tải JSON:", error);
    });
}

// Render danh sách tỉnh/thành phố
function renderCity(data) {
  if (!Array.isArray(data)) {
    console.error("Dữ liệu không hợp lệ:", data);
    return;
  }

  citySelect.innerHTML = '<option selected value="">Chọn Tỉnh/Thành phố của bạn</option>';
  districtSelect.innerHTML = '<option selected value="">Chọn Quận/Huyện của bạn</option>';

  data.forEach(city => {
    if (city.Name && city.Id) {
      citySelect.options[citySelect.options.length] = new Option(city.Name, city.Id);
    } else {
      console.warn("Lỗi dữ liệu city:", city);
    }
  });

  // Xử lý sự kiện khi chọn thành phố
  citySelect.onchange = function () {
    districtSelect.length = 1; // Xóa danh sách quận/huyện cũ
    let selectedCity = data.find(c => c.Id === this.value);

    if (selectedCity && Array.isArray(selectedCity.Districts)) {
      selectedCity.Districts.forEach(district => {
        if (district.Name && district.Id) {
          districtSelect.options[districtSelect.options.length] = new Option(district.Name, district.Id);
        }
      });
    } else {
      console.warn("Không tìm thấy quận/huyện cho thành phố:", this.value);
    }
  };
}
