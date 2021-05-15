# aria-role-demos
A list of demos to show how aria roles function with screen readers.

# Style Notes

1. All font-sizes are converted to rems. This is done via less.  If you want a font-size of 20px, then you would do the following:

```
div {
    font-size: (20/@px);
}
```

The `@px` variable is set to 16rem, which is also the base font size

2. If we hide custom components and use CSS to create custom facades for them, we must ensure that these facades will be discoverable to users navigating by touch. For more information about being inclusive of users navigating by touch, please read Inclusively Hiding & Styling Checkboxes and Radio Buttons by Sara Soueidan. https://www.sarasoueidan.com/blog/inclusively-hiding-and-styling-checkboxes-and-radio-buttons/

## References
https://www.nvaccess.org/files/nvda/documentation/userGuide.html
https://dequeuniversity.com/screenreaders/survival-guide
