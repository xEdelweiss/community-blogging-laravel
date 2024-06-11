# Community blogging platform

![UI Example](https://sverdlykivskyi.net.ua/misc/spilka/ui.png?v2)

# Run in development mode

```shell
docker-compose up
php artisan serve
```

# Install storage link

```shell
php artisan storage:link
```

# FAQ

#### Blade component constructor receives an empty entity
```shell
php artisan optimize:clear
```

# Known issues

- ImageBlockView is redrawing on click due to decorators, this leads to image refetching
- TextArea height is not recalculated after the page was resized

# TODO

- [ ] Ensure the frontend Post editor works as expected
  - [x] Highlight embeds selection in the editor (see `.ProseMirror-selectednode`)
  - [ ] Sometimes multiple embeds are selected
- [ ] Ensure Post content rendering is consistent with the editor
  - [ ] Implement Table of Contents rendering by PHP
  - [ ] Implement Image rendering by PHP
- [ ] Should the cover image be displayed if embed is added?
- [ ] Refactor Likes/Dislikes to get rid of liked/rate/score mix
