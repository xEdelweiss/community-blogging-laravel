# Run in development mode

```shell
npm run dev
php artisan serve
```

# Install storage link

```shell
php artisan storage:link
```

# FAQ

#### Blade component constructor receives empty entity
```shell
php artisan optimize:clear
```

# Known issues

- "Component already initialized":
    1. Logout
    2. Click "Write post" -> Redirect to login page
    3. "New post" page is opened, but editor is not initialized
- ImageBlockView is redrawing on click due to decorators, this leads to image refetching
- TextArea height is not recalculated after page was resized

# TODO

- [x] Highlight embeds selection in editor (see `.ProseMirror-selectednode`)
- [ ] Sometimes multiple embeds are selected
- [ ] Should cover image be displayed if embed is added?
