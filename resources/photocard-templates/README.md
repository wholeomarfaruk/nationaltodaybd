# PhotoCard Template Schema

Templates are JSON files in this directory. They are seeded into the
`photocard_templates` table by `PhotoCardTemplateSeeder` (which auto-discovers
every `*.json` here), and rendered server-side with ImageMagick by
`App\Services\PhotoCard\PhotoCardService`.

The canvas is 1080×1080 by default. All coordinates are **top-left based** and
in canvas pixels. Elements are drawn in array order (later = on top).

## Top-level keys

| Key               | Type   | Notes |
|-------------------|--------|-------|
| `name`            | string | Human name shown in admin. |
| `slug`            | string | Unique id; the file's identity. |
| `description`     | string | Optional. |
| `canvas`          | object | `{ width, height, background }`. |
| `required_fields` | array  | Field keys that must resolve to a value or generation fails. |
| `optional_fields` | array  | Extra mappable field keys. |
| `date_format`     | string | PHP `date()` tokens, rendered in Bengali (see below). |
| `language`        | string | `bn`. |
| `elements`        | array  | The draw list. |

## Dynamic data

Text and image elements can pull data two ways:
- `"field": "title"` — bound to a resolved field (title, logo, image, date,
  category, …). Mappings live in `photocard_field_maps` and are editable in
  admin. `date` is formatted per `date_format`, localised to Bengali digits +
  month names (e.g. `২৪ এপ্রিল, ২০২৬`).
- `"value": "..."` — literal text. Supports `{placeholders}` replaced from the
  resolved data, e.g. `"{category} | {date}"`.

## Element modifiers (work on ANY element)

Each element is rendered onto its **own transparent layer**, so these affect
only that element — never the whole card:

| Modifier  | Shape |
|-----------|-------|
| `opacity` | 0–1, fades just this element. |
| `radius`  | corner radius (rectangle/circle/badge draw their own; images/gradients get clipped). |
| `border`  | `{ width, color, radius }`. |
| `shadow`  | `{ x, y, blur, color, opacity }` soft drop shadow. |
| `center_x` / `center_y` | bool; auto-centers on the canvas. |

## Element types

### `image`
`field` or `src`, `x`, `y`, `w`, `h`, `fit` (`cover` | `contain` | `stretch`).

### `text`
`field` or `value`, `x`, `y`, `font`, `size`, `color`, `align`
(`left`|`center`|`right`), `max_width` (enables word wrap), `line_height`,
`max_lines` (truncates with `…`), `text_shadow` `{x,y,blur,color,opacity}`,
`stroke` `{color,width}`. `y` is the baseline of the first line.

### `rectangle`
`x`, `y`, `w`, `h`, `fill`, `radius`.

### `line`
`x`, `y`, then `w` (horizontal) or `x2`,`y2` (arbitrary), `thickness`, `color`.

### `circle`
`x`, `y`, `d` (diameter) or `w`,`h` (ellipse), `fill`.

### `gradient`
`x`, `y`, `w`, `h`, `from`, `to` (accept `#rrggbb` or `#rrggbbaa`),
`direction` (`vertical` | `horizontal`). Great for legibility overlays.

### `badge`
Rounded pill + centered label in one element: `x`, `y`, `w`, `h`, `radius`,
`fill`, `value` or `field`, `font`, `size`, `color`.

## Previews

`PreviewGenerator` renders each template with sample data to
`public/photocards/previews/{slug}.png` and stores it on the model's
`preview_image` (shown as a thumbnail in admin). Regenerated on seed.
