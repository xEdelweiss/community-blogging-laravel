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

#### Blade component constructor receives empty entity
```shell
php artisan optimize:clear
```

# Known issues

- ImageBlockView is redrawing on click due to decorators, this leads to image refetching
- TextArea height is not recalculated after page was resized

# TODO

- [ ] Ensure frontend Post editor works as expected
  - [x] Highlight embeds selection in editor (see `.ProseMirror-selectednode`)
  - [ ] Sometimes multiple embeds are selected
- [ ] Ensure Post content rendering is consistent with editor
  - [ ] Implement Table of Contents rendering by PHP
  - [ ] Implement Image rendering by PHP
- [ ] Should cover image be displayed if embed is added?
- [ ] Refactor Likes/Dislikes to get rid of liked/rate/score mix
