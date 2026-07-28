---
name: Istiqomah Digital Identity
colors:
  surface: '#f9f9fc'
  surface-dim: '#dadadc'
  surface-bright: '#f9f9fc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3f6'
  surface-container: '#eeeef0'
  surface-container-high: '#e8e8ea'
  surface-container-highest: '#e2e2e5'
  on-surface: '#1a1c1e'
  on-surface-variant: '#43474f'
  inverse-surface: '#2f3133'
  inverse-on-surface: '#f0f0f3'
  outline: '#737780'
  outline-variant: '#c3c6d1'
  surface-tint: '#3a5f94'
  primary: '#001e40'
  on-primary: '#ffffff'
  primary-container: '#003366'
  on-primary-container: '#799dd6'
  inverse-primary: '#a7c8ff'
  secondary: '#705d00'
  on-secondary: '#ffffff'
  secondary-container: '#fcd400'
  on-secondary-container: '#6e5c00'
  tertiary: '#001d44'
  on-tertiary: '#ffffff'
  tertiary-container: '#00316c'
  on-tertiary-container: '#629afb'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d5e3ff'
  primary-fixed-dim: '#a7c8ff'
  on-primary-fixed: '#001b3c'
  on-primary-fixed-variant: '#1f477b'
  secondary-fixed: '#ffe16d'
  secondary-fixed-dim: '#e9c400'
  on-secondary-fixed: '#221b00'
  on-secondary-fixed-variant: '#544600'
  tertiary-fixed: '#d7e2ff'
  tertiary-fixed-dim: '#acc7ff'
  on-tertiary-fixed: '#001a40'
  on-tertiary-fixed-variant: '#004491'
  background: '#f9f9fc'
  on-background: '#1a1c1e'
  surface-variant: '#e2e2e5'
typography:
  headline-xl:
    fontFamily: Montserrat
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
  headline-lg:
    fontFamily: Montserrat
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  headline-md:
    fontFamily: Montserrat
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.5px
  headline-xl-mobile:
    fontFamily: Montserrat
    fontSize: 26px
    fontWeight: '700'
    lineHeight: 32px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 40px
  container-margin-mobile: 16px
  container-margin-desktop: 64px
  gutter: 16px
---

## Brand & Style

The design system is built to reflect the core values of SMK Istiqomah Muhammadiyah 4 Samarinda: Islamic integrity, technical excellence, and creative innovation. The aesthetic bridges the gap between traditional educational stability and the fast-paced nature of its two primary departments: TKJT (Computer Network Engineering & Telecommunications) and DKV (Visual Communication Design).

The design style is **Corporate Modern** with a focus on high-performance mobile usability. It utilizes a clean, card-based interface that prioritizes information density for admin tasks while maintaining an inviting, accessible feel for students and parents. The visual narrative is structured, reliable, and optimistic, ensuring that the technology feels like an enabler of the school’s spiritual and educational mission.

## Colors

This color palette is strategically split to represent the school's specialized tracks while maintaining a unified institutional feel.

*   **Primary (Deep Blue):** Used for the TKJT department and core institutional branding. It signifies trust, technical precision, and professionalism.
*   **Secondary (Vibrant Yellow):** Used for the DKV department and high-priority calls to action. It injects energy, creativity, and visibility into the UI.
*   **Neutral Palette:** 
    *   **Dark Navy (#1A1C1E):** Applied to primary text for high readability and a sophisticated alternative to pure black.
    *   **Light Gray (#F1F3F5):** Used for backgrounds and surface separations.
    *   **White (#FFFFFF):** The base for all cards and primary containers to ensure a clean, "breathable" interface.

## Typography

The typography system pairs **Montserrat** for headings with **Inter** for body text. Montserrat provides a geometric, confident personality for the school’s brand, while Inter ensures maximum legibility for the 80% mobile user base, especially when viewing grades or technical documentation.

Headlines use a bold weight to establish clear hierarchy on small screens. For mobile views, the `headline-xl` scale is reduced to `headline-xl-mobile` to prevent awkward line breaks on narrow devices. Body text is kept at a minimum of 14px to ensure accessibility for all users.

## Layout & Spacing

The design system utilizes a **fluid grid** optimized for mobile-first consumption. 

*   **Mobile (Default):** A 4-column layout with 16px side margins and 16px gutters. Most content should be contained within full-width cards.
*   **Desktop (Admin):** A 12-column layout with 64px side margins. Admin dashboards should use a sidebar navigation (280px fixed) with a fluid content area for data tables and student management tools.

Spacing follows a 4px baseline grid, ensuring that all vertical rhythms are consistent. Use `md (16px)` for standard padding inside cards and `lg (24px)` for section separation.

## Elevation & Depth

This design system uses **Ambient Shadows** to create a sense of tactile layering. Surfaces are elevated only when they contain actionable or distinct information.

*   **Level 0 (Background):** Light Gray (#F1F3F5). Used for the base canvas.
*   **Level 1 (Cards):** White (#FFFFFF) with a soft, diffused shadow (0px 4px 12px rgba(0, 51, 102, 0.08)). The shadow is slightly tinted with the Primary Deep Blue to maintain brand harmony.
*   **Level 2 (Modals/Overlays):** White (#FFFFFF) with a more pronounced shadow (0px 8px 24px rgba(0, 51, 102, 0.12)).

Outlines are avoided unless used for secondary buttons or input fields, favoring soft shadows to define boundaries.

## Shapes

The shape language is defined by **12px (rounded-lg)** corners for primary UI elements. This specific radius provides a balance between the friendly nature of a school and the professional structure of a technical vocational institution.

*   **Main Cards:** 12px (rounded-lg).
*   **Buttons & Inputs:** 8px (rounded-md) to provide a slightly more "precise" technical look.
*   **Small Elements (Chips/Badges):** 4px (rounded-sm) or fully pill-shaped depending on the context of the metadata.

## Components

### Buttons
*   **Primary:** Solid Primary Blue or Secondary Yellow background with high-contrast text. Secondary Yellow is reserved for "Apply Now" or "Critical Action" buttons to ensure visibility.
*   **Secondary:** Outlined with Primary Blue, 2px border width.
*   **Rounding:** 8px.

### Cards
Cards are the primary container for all content. They must feature a white background, 12px corner radius, and the Level 1 Ambient Shadow. For department-specific cards (TKJT/DKV), a 4px top-border accent in the respective department color is recommended.

### Input Fields
Inputs should have a light gray fill (#F8F9FA) and a 1px border (#DEE2E6). On focus, the border shifts to Primary Blue with a subtle 2px outer glow.

### Chips & Badges
Used for status indicators (e.g., "Hadir", "Izin", "Lulus"). These use low-saturation versions of the status color (Success/Warning/Error) with dark text to remain readable on mobile screens.

### Navigation
*   **Mobile:** A fixed bottom navigation bar with icons for Home, Schedule, Grades, and Profile.
*   **Desktop:** A vertical sidebar on the left for administrative tools, using the Primary Deep Blue as the background for the sidebar to denote authority.