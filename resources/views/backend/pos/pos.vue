To customize this Vue component, you can make changes to the template, script, and style sections based on your requirements. Here are a few examples of customizations you might want to consider:

1. **Change the Logo**:
  Update the logo image source in the template section.
  ```vue
  <img :src="'/images/' + currentUser.logo" alt width="60" height="60">
  ```

2. **Add New Languages**:
  Add new languages to the `langs` array in the data section.
  ```javascript
  langs: [
    "en",
    "fr",
    "ar",
    "de",
    "es",
    "it",
    "Ind",
    "thai",
    "tr_ch",
    "sm_ch",
    "tur",
    "ru",
    "hn",
    "vn",
    "kr",
    "ba",
    "br",
    "jp", // Add Japanese
    "nl"  // Add Dutch
  ],
  ```

3. **Modify the Payment Methods**:
  Add or remove payment methods in the `payment` object.
  ```javascript
  payment: {
    amount: "",
    received_amount: "",
    Reglement: "",
    notes: "",
    method: "Cash" // Default payment method
  },
  ```

4. **Change the Styling**:
  Update the CSS in the style section to change the appearance.
  ```css
  .total {
    font-weight: bold;
    font-size: 16px; /* Increase font size */
    color: #333; /* Change text color */
  }
  ```

5. **Add New Features**:
  Add new methods or computed properties to enhance functionality.
  ```javascript
  methods: {
    ...mapActions(["changeSidebarProperties", "changeThemeMode", "logout"]),
    // New method to apply discount
    applyDiscount() {
     this.sale.discount = this.sale.discount * 0.9; // Apply a 10% discount
     this.CaclulTotal();
    },
    // Existing methods...
  }
  ```

6. **Update the Template**:
  Modify the template to add new elements or change the layout.
  ```vue
  <b-col md="6" sm="12">
    <b-form-group :label="$t('Discount')">
     <b-form-input v-model="sale.discount" @input="applyDiscount"></b-form-input>
    </b-form-group>
  </b-col>
  ```

These are just a few examples of how you can customize the component. Depending on your specific needs, you can make various other changes to the template, script, and style sections.
