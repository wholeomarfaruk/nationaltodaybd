# Photocard Template Specification

**Version:** 1.0 (Phase 1 + Phase 2.1-2.9)  
**Last Updated:** 2026-06-03  
**Status:** Production Ready

---

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Rendering Flow](#rendering-flow)
3. [Template Structure](#template-structure)
4. [Canvas Configuration](#canvas-configuration)
5. [Field Validation](#field-validation)
6. [Element System](#element-system)
7. [Element Types](#element-types)
8. [Variable System](#variable-system)
9. [Design Rules](#design-rules)
10. [Phase 2 Features](#phase-2-features)
11. [Future Roadmap](#future-roadmap)
12. [Examples](#examples)

---

## Architecture Overview

### Core Principle

**Template-driven, PHP-agnostic design engine.**

- JSON defines layout
- PHP only executes
- New templates = zero PHP changes
- All design decisions in JSON

### Technology Stack

| Component | Technology | Role |
|-----------|-----------|------|
| Template Format | JSON | Configuration |
| Rendering Engine | Imagick | Image manipulation |
| PHP Framework | Laravel | Application context |
| Font Support | TTF/OTF | Typography |

---

## Rendering Flow

```
Template JSON
    ↓
PhotoCardGenerator::generate()
    ├─ Load template
    ├─ Validate data
    └─ Create canvas
        ↓
    foreach (elements)
        ↓
    ImageRenderer::render()
        ├─ Type dispatch
        ├─ Render element
        └─ Apply modifiers
        ↓
    Canvas composite
        ↓
    PNG output
```

### Processing Order

1. **Canvas Creation** - Background color applied
2. **Element Loop** - Sequential rendering (array order)
3. **Per-Element**:
   - Render by type (image/text/rectangle)
   - Apply modifiers (opacity/border/shadow/etc)
4. **Output** - PNG file generated

**Critical:** Render order = JSON element order. First element renders behind last element.

---

## Template Structure

### Root Schema

```json
{
  "name": "Template Name",
  "slug": "template-slug",
  "description": "Template description",

  "canvas": {
    "width": 1080,
    "height": 1080,
    "background": "#ffffff"
  },

  "required_fields": ["field1", "field2"],
  "optional_fields": ["field3", "field4"],

  "date_format": "d M Y",
  "language": "bn",

  "elements": [...]
}
```

### Metadata

| Field | Type | Required | Purpose |
|-------|------|----------|---------|
| `name` | string | Yes | Display name in UI |
| `slug` | string | Yes | URL-safe identifier (unique) |
| `description` | string | No | Template description |
| `canvas` | object | Yes | Dimensions & background |
| `required_fields` | array | Yes | API validation |
| `optional_fields` | array | No | Data hints |
| `date_format` | string | No | Date format string (PHP date() format) |
| `language` | string | No | Template language code (bn, en, etc) |
| `elements` | array | Yes | Render elements |

---

## Canvas Configuration

### Schema

```json
{
  "canvas": {
    "width": 1080,
    "height": 1080,
    "background": "#f1d2c3"
  }
}
```

### Attributes

| Attribute | Type | Range | Example | Notes |
|-----------|------|-------|---------|-------|
| `width` | integer | > 0 | 1080 | Canvas pixel width |
| `height` | integer | > 0 | 1080 | Canvas pixel height |
| `background` | color | hex/rgb | #ffffff | Background fill |

### Common Sizes

| Purpose | Dimensions | Aspect |
|---------|-----------|--------|
| Social Media Square | 1080×1080 | 1:1 |
| Story | 1080×1920 | 9:16 |
| Landscape | 1920×1080 | 16:9 |
| Portrait | 1080×1440 | 3:4 |

---

## Field Validation

### Required Fields

Passed by API, validated at generation time.

```json
{
  "required_fields": ["title", "image", "date"]
}
```

Example API input:

```php
[
    'title' => 'Breaking News Title',
    'image' => '/uploads/hero.jpg',
    'date' => '2026-06-03'
]
```

**Error if missing:** `Missing required field: {field}`

### Optional Fields

Hints to API but not enforced.

```json
{
  "optional_fields": ["caption", "category", "author"]
}
```

---

## Element System

### Core Concept

**Elements are rendered in array order.**

```json
{
  "elements": [
    {"type": "image", ...},    // Rendered first (background)
    {"type": "rectangle", ...}, // Rendered second
    {"type": "text", ...}       // Rendered last (foreground)
  ]
}
```

### Element Base Schema

Every element has:

```json
{
  "type": "image|text|rectangle",
  "x": 0,
  "y": 0,

  "opacity": 1.0,
  "border": {...},
  "shadow": {...},
  "radius": 0
}
```

---

## Element Types

### Currently Supported

- `image` - Images with fit modes
- `text` - Typography with wrapping
- `rectangle` - Shapes and backgrounds (use rectangle + text for buttons)

### Generic Element Properties

All elements support these auto-positioning properties:

```json
{
  "center_x": true,   // Auto-center horizontally
  "center_y": true    // Auto-center vertically
}
```

**Calculation:**
```
center_x: x = (canvas_width - element_width) / 2
center_y: y = (canvas_height - element_height) / 2
```

### Future Elements

- `circle` - Circular shapes
- `line` - Lines and dividers
- `gradient` - Gradient fills
- `icon` - Vector icons
- `badge` - Badge components
- `qr` - QR codes
- `group` - Nested layouts

---

### Auto-Centering

Any element can be auto-centered using `center_x` and/or `center_y`:

**Horizontal centering (IMAGE):**
```json
{
  "type": "image",
  "field": "hero",
  "center_x": true,
  "y": 100,
  "w": 800,
  "h": 400
}
```

**Vertical centering (RECTANGLE):**
```json
{
  "type": "rectangle",
  "center_y": true,
  "x": 0,
  "w": 1080,
  "h": 200,
  "fill": "#000000"
}
```

**Both (BUTTON):**
```json
{
  "type": "button",
  "value": "Click Me",
  "center_x": true,
  "center_y": true,
  "w": 300,
  "h": 60
}
```

---

### IMAGE Element

Renders images from data fields with aspect-ratio control.

#### Schema

```json
{
  "type": "image",
  "field": "image",

  "x": 0,
  "y": 0,
  "w": 1080,
  "h": 610,

  "fit": "cover",
  "opacity": 1.0,

  "border": {
    "width": 2,
    "color": "#ffffff"
  },

  "radius": 15,

  "shadow": {
    "x": 5,
    "y": 5,
    "blur": 10,
    "color": "#000000",
    "opacity": 0.3
  }
}
```

#### Attributes

| Attribute | Type | Required | Notes |
|-----------|------|----------|-------|
| `type` | string | Yes | Must be `"image"` |
| `field` | string | Yes | Data field name |
| `x` | integer | Conditional | X position (required if `center_x` not set) |
| `y` | integer | Conditional | Y position (required if `center_y` not set) |
| `center_x` | boolean | No | Auto-center horizontally |
| `center_y` | boolean | No | Auto-center vertically |
| `w` | integer | Yes | Width (pixels) |
| `h` | integer | Yes | Height (pixels) |
| `fit` | string | No | `cover`, `contain`, `stretch` (default: `contain`) |
| `opacity` | float | No | 0.0-1.0 (default: 1.0) |
| `border` | object | No | Border styling |
| `radius` | integer | No | Rounded corners (pixels) |
| `shadow` | object | No | Drop shadow |

#### Fit Modes

| Mode | Behavior | Use Case |
|------|----------|----------|
| `cover` | Fill area, crop excess | Hero images |
| `contain` | Fit inside, preserve aspect | Logos, icons |
| `stretch` | Stretch to exact size | Backgrounds |

#### Example

```json
{
  "type": "image",
  "field": "hero",
  "x": 0,
  "y": 0,
  "w": 1080,
  "h": 610,
  "fit": "cover",
  "opacity": 0.95,
  "shadow": {
    "x": 3,
    "y": 3,
    "blur": 8,
    "color": "#000000",
    "opacity": 0.2
  }
}
```

---

### TEXT Element

Renders dynamic or static text with typography control.

#### Schema (Dynamic Field)

```json
{
  "type": "text",
  "field": "title",

  "x": 40,
  "y": 730,

  "font": "fonts/NotoSansBengali-Bold.ttf",
  "size": 68,
  "color": "#004da8",

  "max_width": 1000,
  "align": "center",
  "line_height": 95,
  "max_lines": 3,

  "stroke": {
    "color": "#ffffff",
    "width": 2
  },

  "text_shadow": {
    "x": 2,
    "y": 2,
    "blur": 4,
    "color": "#000000",
    "opacity": 0.2
  },

  "opacity": 1.0
}
```

#### Schema (Static Text)

```json
{
  "type": "text",
  "value": "National Today",

  "x": 40,
  "y": 1040,

  "font": "fonts/NotoSansBengali-Regular.ttf",
  "size": 28,
  "color": "#000000"
}
```

#### Schema (Variable Text)

```json
{
  "type": "text",
  "value": "{date} · nationaltoday.com",

  "x": 30,
  "y": 1050,

  "font": "fonts/NotoSansBengali-Regular.ttf",
  "size": 28,
  "color": "#000000"
}
```

#### Attributes

| Attribute | Type | Required | Notes |
|-----------|------|----------|-------|
| `type` | string | Yes | Must be `"text"` |
| `field` | string | Conditional | Data field name (use `field` OR `value`) |
| `value` | string | Conditional | Static/variable text |
| `x` | integer | Conditional | X position (required if `center_x` not set) |
| `y` | integer | Conditional | Y position (required if `center_y` not set) |
| `center_x` | boolean | No | Auto-center horizontally |
| `center_y` | boolean | No | Auto-center vertically |
| `font` | string | Yes | Font file path (relative to public/) |
| `size` | integer | Yes | Font size (pixels) |
| `color` | color | Yes | Text color (hex) |
| `max_width` | integer | No | Text wrapping width |
| `align` | string | No | `left`, `center`, `right` (default: `left`) |
| `line_height` | integer | No | Line spacing (pixels) |
| `max_lines` | integer | No | Maximum lines (truncates with ...) |
| `stroke` | object | No | Text outline |
| `text_shadow` | object | No | Text shadow |
| `opacity` | float | No | Text opacity (0.0-1.0) |

#### Font Paths

All fonts relative to `public/`:

```
public/
├── fonts/
│   ├── NotoSansBengali-Regular.ttf
│   ├── NotoSansBengali-Bold.ttf
│   └── NotoSansBengali-SemiBold.ttf
```

Usage:

```json
"font": "fonts/NotoSansBengali-Bold.ttf"
```

#### Text Alignment

| Value | Behavior |
|-------|----------|
| `left` | Align to left edge |
| `center` | Center within max_width |
| `right` | Align to right edge |

#### Examples

**Dynamic title with wrap and shadow:**

```json
{
  "type": "text",
  "field": "title",
  "x": 80,
  "y": 730,
  "max_width": 920,
  "font": "fonts/NotoSansBengali-Bold.ttf",
  "size": 68,
  "color": "#004da8",
  "align": "center",
  "line_height": 95,
  "max_lines": 3,
  "text_shadow": {
    "x": 2,
    "y": 2,
    "color": "#000000",
    "opacity": 0.2
  }
}
```

**Variable footer text:**

```json
{
  "type": "text",
  "value": "{date} · {category}",
  "x": 30,
  "y": 1050,
  "font": "fonts/NotoSansBengali-Regular.ttf",
  "size": 28,
  "color": "#000000"
}
```

---

  "w": 1080,
  "h": 80,

  "fill": "#ffffff",
  "opacity": 0.98,

  "border": {
    "width": 2,
    "color": "#cccccc"
  },

  "radius": 10,

  "shadow": {
    "x": 0,
    "y": 2,
    "blur": 4,
    "color": "#000000",
    "opacity": 0.1
  }
}
```

#### Attributes

| Attribute | Type | Required | Notes |
|-----------|------|----------|-------|
| `type` | string | Yes | Must be `"rectangle"` |
| `x` | integer | Conditional | X position (required if `center_x` not set) |
| `y` | integer | Conditional | Y position (required if `center_y` not set) |
| `center_x` | boolean | No | Auto-center horizontally |
| `center_y` | boolean | No | Auto-center vertically |
| `w` | integer | Yes | Width |
| `h` | integer | Yes | Height |
| `fill` | color | Yes | Fill color |
| `opacity` | float | No | Opacity (0.0-1.0) |
| `border` | object | No | Border stroke |
| `radius` | integer | No | Rounded corners |
| `shadow` | object | No | Drop shadow |

#### Use Cases

**Background overlay:**

```json
{
  "type": "rectangle",
  "x": 0,
  "y": 0,
  "w": 1080,
  "h": 1080,
  "fill": "#000000",
  "opacity": 0.4
}
```

**Footer background:**

```json
{
  "type": "rectangle",
  "x": 0,
  "y": 1000,
  "w": 1080,
  "h": 80,
  "fill": "#ffffff",
  "opacity": 0.95,
  "radius": 5
}
```

**Divider line:**

```json
{
  "type": "rectangle",
  "x": 40,
  "y": 680,
  "w": 1000,
  "h": 2,
  "fill": "#cccccc",
  "opacity": 0.5
}
```

---

## Variable System

### Available Variables

Dynamic text substitution from API data.

| Variable | Source | Format |
|----------|--------|--------|
| `{title}` | `required_fields` | String |
| `{caption}` | `optional_fields` | String |
| `{category}` | `optional_fields` | String |
| `{date}` | `required_fields` | String (formatted by `date_format`) |
| `{any_field}` | Any field in data | String |

### Date Formatting

Template specifies PHP date() format:

```json
{
  "date_format": "d M Y"
}
```

API provides ISO date:

```php
[
    'date' => '2026-06-03'
]
```

Rendered as:

```
03 Jun 2026
```

### Variable Replacement Rules

1. **Exact match only:** `{title}` matches exactly
2. **Case sensitive:** `{Title}` ≠ `{title}`
3. **Whitespace preserved:** `{date}` with spaces renders as-is
4. **Multiple per element:** `{date} · {category}` both substituted
5. **Undefined variables:** Replaced with empty string

### Examples

**Date footer:**

```json
{
  "value": "{date} · nationaltoday.com"
}
```

Output (example):

```
03 Jun 2026 · nationaltoday.com
```

**Category and date:**

```json
{
  "value": "{category} | {date}"
}
```

Output:

```
জাতীয় | 03 Jun 2026
```

---

## Phase 2 Features

### 2.1 Opacity

Transparency for any element.

```json
{
  "opacity": 0.8
}
```

| Range | Value |
|-------|-------|
| 0.0 | Fully transparent |
| 0.5 | 50% opacity |
| 1.0 | Fully opaque |

**Works on:** image, rectangle, text

---

### 2.2 Border

Stroke around elements.

```json
{
  "border": {
    "width": 3,
    "color": "#ffffff"
  }
}
```

| Property | Type | Notes |
|----------|------|-------|
| `width` | integer | Stroke width (pixels) |
| `color` | color | Stroke color (hex) |

**Works on:** rectangle, image

---

### 2.3 Border Radius

Rounded corners.

```json
{
  "radius": 20
}
```

| Value | Result |
|-------|--------|
| 0 | Sharp corners |
| 10 | Slightly rounded |
| 20 | Rounded |
| 50+ | Pill shape |

**Works on:** rectangle, image

---

### 2.4 Shadow

Drop shadow for depth.

```json
{
  "shadow": {
    "x": 5,
    "y": 5,
    "blur": 15,
    "color": "#000000",
    "opacity": 0.3
  }
}
```

| Property | Type | Notes |
|----------|------|-------|
| `x` | integer | Shadow X offset |
| `y` | integer | Shadow Y offset |
| `blur` | integer | Blur radius |
| `color` | color | Shadow color |
| `opacity` | float | Shadow opacity (0-1) |

**Works on:** rectangle, image

---

### 2.8 Text Stroke

Text outline/border.

```json
{
  "stroke": {
    "color": "#ffffff",
    "width": 2
  }
}
```

| Property | Type | Notes |
|----------|------|-------|
| `color` | color | Stroke color |
| `width` | integer | Stroke width (pixels) |

**Works on:** text

---

### 2.9 Text Shadow

Shadow for text readability.

```json
{
  "text_shadow": {
    "x": 2,
    "y": 2,
    "blur": 4,
    "color": "#000000",
    "opacity": 0.2
  }
}
```

| Property | Type | Notes |
|----------|------|-------|
| `x` | integer | Shadow X offset |
| `y` | integer | Shadow Y offset |
| `blur` | integer | Blur radius |
| `color` | color | Shadow color |
| `opacity` | float | Shadow opacity |

**Works on:** text

---

## Design Rules

### Template Design Pattern

Organize elements logically:

```json
{
  "elements": [
    // Layer 1: Background
    {"type": "image", "field": "image"},
    {"type": "rectangle", "fill": "#000000", "opacity": 0.3},

    // Layer 2: Content
    {"type": "image", "field": "logo"},
    {"type": "text", "field": "title"},
    {"type": "text", "field": "caption"},

    // Layer 3: Footer
    {"type": "rectangle", "y": 1000},
    {"type": "text", "value": "{date}"}
  ]
}
```

### Best Practices

✅ **DO:**

- Order elements from background to foreground
- Use max_width for long text
- Provide text shadow on image backgrounds
- Use opacity for overlays (not fill color)
- Document element purpose in comments
- Test with various content lengths

❌ **DON'T:**

- Hardcode positions without testing
- Use tiny fonts (minimum 24px for body)
- Overlap text without shadow
- Forget to handle long titles
- Use poor contrast colors

### Color Accessibility

| Element | Foreground | Background | Contrast Ratio |
|---------|-----------|-----------|-----------------|
| Title | #004da8 (blue) | #f1d2c3 (beige) | 8.5:1 ✅ |
| Text | #000000 (black) | #ffffff (white) | 21:1 ✅ |
| Footer | #666666 (gray) | #ffffff (white) | 7.5:1 ✅ |

---

## Future Roadmap

### Phase 2.5 - Gradient

```json
{
  "gradient": {
    "type": "linear",
    "direction": "vertical",
    "from": "#000000",
    "to": "#ffffff"
  }
}
```

### Phase 2.10 - Auto Font Resize

```json
{
  "auto_fit": true,
  "min_size": 32
}
```

### Phase 2.11 - Layer Groups

```json
{
  "type": "group",
  "elements": [...]
}
```

### Phase 3 - Advanced Shapes

- Circle/Ellipse
- Line/Path
- Polygon
- SVG support

### Phase 4 - Animation

- Keyframe support
- Video output
- GIF generation

---

## Examples

### Example 1: News Card with Button

```json
{
  "name": "News Card",
  "slug": "news-card",
  "canvas": {
    "width": 1080,
    "height": 1080,
    "background": "#f1d2c3"
  },
  "required_fields": ["title", "image", "logo", "date"],
  "optional_fields": ["caption"],
  "elements": [
    {
      "type": "image",
      "field": "image",
      "x": 0, "y": 0,
      "w": 1080, "h": 610,
      "fit": "cover",
      "opacity": 0.95
    },
    {
      "type": "image",
      "field": "logo",
      "x": 370, "y": 530,
      "w": 340, "h": 150,
      "fit": "contain"
    },
    {
      "type": "text",
      "field": "title",
      "x": 40, "y": 730,
      "max_width": 1000,
      "font": "fonts/NotoSansBengali-Bold.ttf",
      "size": 68,
      "color": "#004da8",
      "align": "center",
      "line_height": 95,
      "max_lines": 3,
      "text_shadow": {
        "x": 2, "y": 2,
        "blur": 4,
        "color": "#000000",
        "opacity": 0.2
      }
    },
    {
      "type": "rectangle",
      "x": 0, "y": 1000,
      "w": 1080, "h": 80,
      "fill": "#ffffff",
      "opacity": 0.98
    },
    {
      "type": "button",
      "value": "Breaking News",
      "x": 550, "y": 1020,
      "w": 200, "h": 50,
      "background": "#ff0000",
      "color": "#ffffff",
      "font": "fonts/NotoSansBengali-Bold.ttf",
      "size": 24,
      "radius": 5,
      "text_shadow": {
        "x": 1, "y": 1,
        "blur": 2,
        "color": "#000000",
        "opacity": 0.2
      }
    },
    {
      "type": "text",
      "value": "{date}",
      "x": 30, "y": 1050,
      "font": "fonts/NotoSansBengali-Regular.ttf",
      "size": 28,
      "color": "#000000"
    }
  ]
}
```

### Example 2: Social Story

```json
{
  "name": "Social Story",
  "slug": "social-story",
  "canvas": {
    "width": 1080,
    "height": 1920,
    "background": "#ffffff"
  },
  "required_fields": ["title", "image"],
  "elements": [
    {
      "type": "image",
      "field": "image",
      "x": 0, "y": 0,
      "w": 1080, "h": 1920,
      "fit": "cover"
    },
    {
      "type": "rectangle",
      "x": 0, "y": 0,
      "w": 1080, "h": 1920,
      "fill": "#000000",
      "opacity": 0.3
    },
    {
      "type": "text",
      "field": "title",
      "x": 40, "y": 850,
      "max_width": 1000,
      "font": "fonts/NotoSansBengali-Bold.ttf",
      "size": 96,
      "color": "#ffffff",
      "align": "center",
      "text_shadow": {
        "x": 3, "y": 3,
        "blur": 8,
        "color": "#000000",
        "opacity": 0.5
      }
    }
  ]
}
```

---

## Implementation Notes

### For Template Creators

1. Use screenshot as reference
2. Measure pixel positions carefully
3. Test with both short and long content
4. Validate required_fields match API
5. Document optional_fields for frontend hints

### For Developers

1. No PHP changes needed for new templates
2. Use spec as single source of truth
3. Validate JSON against this spec
4. Report issues with element rendering
5. PR templates with spec link

### For Designers

1. Export design as dimensions
2. Follow render order rules
3. Use accessible color contrast
4. Account for text wrapping
5. Provide fallback layouts

---

## Support & Issues

**Report issues with:**

- Attribute not working
- Rendering incorrect
- Performance problems
- Undocumented behavior

**Include:**

- Template JSON
- Input data
- Expected vs actual output
- Screenshot/generated image

---

**End of Specification**
