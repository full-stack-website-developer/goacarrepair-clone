function addField(type) {
    // Get the fieldset element where fields will be appended
    const fieldset = document.querySelector('fieldset');
    
    // Create a wrapper div for the new field
    const wrapper = document.createElement('div');
    wrapper.classList.add('row', 'mb-3', 'align-items-center');
    
    // Define the HTML content based on the type
    let htmlContent = '';
    
    switch (type) {
        case 'heading':
            htmlContent = `
                <div class="col">
                    <label class="form-label mb-1">Heading</label>
                    <input type="text" class="form-control rounded-3" name="additional[][heading]" placeholder="Enter heading text" >
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                </div>
            `;
            break;
            
        case 'paragraph':
            htmlContent = `
                <div class="col">
                    <label class="form-label mb-1">Paragraph</label>
                    <textarea class="form-control rounded-3" name="additional[][paragraphs]" rows="4" placeholder="Enter paragraph text" ></textarea>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                </div>
            `;
            break;
            
        case 'image':
            htmlContent = `
                <div class="col">
                    <label class="form-label mb-1">Image Upload</label>
                    <input type="file" class="form-control rounded-3" name="images[]" accept="image/*" >
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                </div>
            `;
            break;
            
        case 'list':
            htmlContent = `
                <div class="col">
                    <label class="form-label mb-1">List Item</label>
                    <input type="text" class="form-control rounded-3" name="additional[][lists]" placeholder="Enter list item" required>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm rounded-circle remove-btn" aria-label="Remove field">×</button>
                </div>
            `;
            break;
            
        default:
            return; // Exit if type is invalid
    }
    
    // Set the innerHTML of the wrapper
    wrapper.innerHTML = htmlContent;
    
    // Add event listener to the remove button
    const closeButton = wrapper.querySelector('.remove-btn');
    closeButton.addEventListener('click', () => {
        wrapper.remove();
    });
    
    // Append the wrapper to the fieldset
    fieldset.appendChild(wrapper);
}