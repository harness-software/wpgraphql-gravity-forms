# Querying `formFields` and their values

Both [forms](https://docs.gravityforms.com/form-object/) and [entries](https://docs.gravityforms.com/entry-object/) use the `formFields` GraphQL Interface to retrieve information about [Gravity Forms fields](https://docs.gravityforms.com/field-object/), and their submission values.

In addition to the shared fields available on the Interface, each GF Field has its own set of GraphQL fields that are accessible with query fragments.

You can pass `first:300` to `formFields`, where `300` is the maximum number of fields you want to query for.

## Example Query

```graphql
{
  gravityFormsForm(id: 1, idType: DATABASE_ID) {
    formId
    formFields(first: 300) {
      nodes {
        id
        type
        cssClass
        ... on TextField {
          description
          label
          isRequired
        }
        ... on CheckboxField {
          description
          label
          choices {
            isSelected
            text
            value
          }
        }
        ... on NameField {
          description
          label
          inputs {
            isHidden
            label
            placeholder
          }
        }
      }
    }
  }
}
```

Entry values can be accessed similarly to other Gravity Forms Field properties, by including the corresonding GraphQL field in the fragment.

**Note**: Due to GraphQL limitations regarding Union types, you must use the specific value type specific to that field. A full list of field value types and their corresponding field fragments are below.

| Field Value Type               | Used by                                                                                                                                                                                                                                                                  | Available subfields                                              |
| ------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ---------------------------------------------------------------- |
| `addressValues` _( obj )_      | `AddressField`                                                                                                                                                                                                                                                           | `city`<br>`country`<br>`lineTwo`<br>`state`<br>`street`<br>`zip` |
| `checkboxValues` _( [ obj ] )_ | `CheckboxField`                                                                                                                                                                                                                                                          | `inputId`<br>`value`                                             |
| `imageValues` _( obj )_        | `ImageField`                                                                                                                                                                                                                                                             | `altText`<br>`caption`<br>`description`<br>`title`<br>`url`<br>  |
| `listValues` _( [ obj ] )_     | `ListField`                                                                                                                                                                                                                                                              | `values` _( [ string ] )_                                        |
| `nameValues` _( obj )_         | `NameField`                                                                                                                                                                                                                                                              | `first`<br>`last`<br>`middle`<br>`prefix`<br>`suffix`            |
| `timeValues` _( obj )_         | `TimeField`                                                                                                                                                                                                                                                              | `amPm`<br>`displayValue`<br>`hours`<br>`minutes`                 |
| `value` _( string )_           | `ConsentField`<br>`DateField`<br>`EmailField`<br>`HiddenField`<br>`NumberField`<br>`PhoneField`<br>`PostContentField`<br>`PostExcerptField`<br>`PostTitleField`<br>`RadioField`<br>`SelectField`<br>`SignatureField`<br>`TextAreaField`<br>`TextField`<br>`WebsiteField` | n/a                                                              |
| `values` _( [ string] )_       | `ChainedSelectField`<br>`FileUploadField`<br>`MultiSelectField`<br>`PostCategoryField`<br>`PostCustomField`<br>`PostTagsField`                                                                                                                                           | n/a                                                              |

## Example Query

```graphql
{
  gravityFormsEntry(id: 1, idType: DATABASE_ID) {
    entryId
    formFields(first: 300) {
      nodes {
        ... on CheckboxField {
          checkboxValues {
            inputId
            value
          }
        }
        ... on NameField {
          nameValues {
            prefix
            first
            middle
            last
            suffix
          }
        }
        ... on TextField {
          value
        }
      }
    }
  }
}
```
