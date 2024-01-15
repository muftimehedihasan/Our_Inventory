<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
        </div>
        <div class="modal-body">
          <form id="save-form">
            <div class="container">
              <div class="row">
                <div class="col-12 p-1">

                  <label class="form-label">Category</label>
                  <select type="text" class="form-control form-select" id="productCategory">
                    <option value="">Select Category</option>
                  </select>

                  <label class="form-label mt-2">Name</label>
                  <input type="text" class="form-control" id="productName">

                  <label class="form-label mt-2">Price</label>
                  <input type="text" class="form-control" id="productPrice">

                  <label class="form-label mt-2">Quantity</label>
                  <input type="text" class="form-control" id="productQuantity">

                  <br/>
                  <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                  <br/>

                  <label class="form-label">Image</label>
                  <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">

                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
          <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Fetch category options and populate select element
    fetch('/categories')
      .then(response => response.json())
      .then(categories => {
        const categorySelect = document.getElementById('productCategory');
        categories.forEach(category => {
          const option = document.createElement('option');
          option.value = category.id; // Assuming ID is the primary key
          option.text = category.name;
          categorySelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Error fetching categories:', error);
        // Handle the error, e.g., display an error message to the user
      });



      //-------------------------------------------------------------------------------------
    async function Save() {
      // ... your existing Save function code
      async function Save() {
  try {
    // Retrieve correct product data
    const categoryId = document.getElementById('productCategory').value;
    const name = document.getElementById('productName').value;
    const price = document.getElementById('productPrice').value;
    const quantity = document.getElementById('productQuantity').value;
    const img = document.getElementById('productImg').files[0]; // Access selected image file

    // Construct form data including image
    const formData = new FormData();
    formData.append('category_id', categoryId);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('quantity', quantity);
    formData.append('img', img);

    // Send POST request with form data and close modal
    document.getElementById('modal-close').click();
    showLoader();
    const res = await axios.post("/create-product", formData, HeaderToken());
    hideLoader();

    // Handle response
    if (res.data['status'] === "success") {
      successToast(res.data['message']);
      document.getElementById("save-form").reset();
      await getList();
    } else {
      errorToast(res.data['message']);
    }
  } catch (e) {
    unauthorized(e.response.status);
  }
}

    }
  </script>














{{-- //-----------------------------------------------------

<script>

   async function Save() {
  try {
    // Retrieve correct product data
    const categoryId = document.getElementById('productCategory').value;
    const name = document.getElementById('productName').value;
    const price = document.getElementById('productPrice').value;
    const quantity = document.getElementById('productQuantity').value;
    const img = document.getElementById('productImg').files[0]; // Access selected image file

    // Construct form data including image
    const formData = new FormData();
    formData.append('category_id', categoryId);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('quantity', quantity);
    formData.append('img', img);

    // Send POST request with form data and close modal
    document.getElementById('modal-close').click();
    showLoader();
    const res = await axios.post("/create-product", formData, HeaderToken());
    hideLoader();

    // Handle response
    if (res.data['status'] === "success") {
      successToast(res.data['message']);
      document.getElementById("save-form").reset();
      await getList();
    } else {
      errorToast(res.data['message']);
    }
  } catch (e) {
    unauthorized(e.response.status);
  }
}


  </script> --}}


