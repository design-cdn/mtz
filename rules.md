# CLAUDE.md — Project Coding Rules

These rules apply to **every file you touch**. No exceptions. If a rule conflicts with a "faster" approach, the rule wins.

---

## 1. Never hardcode values

| What | Rule | ✅ | ❌ |
|---|---|---|---|
| Colors | Always use CSS custom properties | `var(--color-text-primary)` | `#1a1a2e` |
| Spacing | Always use spacing tokens | `var(--space-lg)` | `32px` |
| Font sizes | Always use typographic tokens | `var(--text-lg)` | `18px` |
| Breakpoints | Always use breakpoint tokens | `var(--breakpoint-md)` | `768px` |
| Z-index | Always use z-index tokens | `var(--z-modal)` | `999` |
| Strings | Always use the i18n system | `{{ __('auth.login') }}` | `<button>Log in</button>` |
| URLs/paths | Always use config, env, or route helpers | `route('dashboard')` | `href="/dashboard"` |
| Magic numbers | Always extract as named constants with a comment | `const TIMEOUT_MS = 3000` | `setTimeout(fn, 3000)` |

---

## 2. CSS architecture

- All design tokens are defined **once** in the token file (`resources/css/tokens.css`) and imported everywhere else. Never re-declare a token in a component.
- Before writing a new CSS rule, check if an existing token or utility already achieves the result.
- Avoid duplicating declarations — extract shared styles into a reusable class or mixin.
- **No inline styles** (`style="..."`). Exception: JS-driven dynamic values — set via `el.style.setProperty('--offset', value)`.
- **No `!important`** except in explicitly designed override utilities (document the reason).
- Component styles must be scoped. Never write bare tag selectors (`p { }`, `h2 { }`) outside the global base stylesheet.

---

## 3. Typography & spacing

**Typographic scale** (defined in token file, never override per-component without reason):

| Token | Usage |
|---|---|
| `--text-xs` | Captions, meta labels |
| `--text-sm` | Secondary body, helper text |
| `--text-base` | Primary body copy |
| `--text-lg` | Lead paragraphs, large body |
| `--text-xl` | Section intros, card titles |
| `--text-2xl` | Section headings (h3) |
| `--text-3xl` | Page sub-headings (h2) |
| `--text-4xl`+ | Hero headings (h1) |

Never skip heading levels for visual reasons — adjust size via token.

**Spacing rhythm** — use the scale, never invent intermediate values:
- Between paragraphs: `--space-md`
- Heading → content: `--space-sm`
- Between page sections: `--space-2xl` or `--space-3xl`
- Grid/flex gaps: always a spacing token

---

## 4. Component structure

- Each component controls its **own internal layout only**.
- A component never sets its own external `margin`, `position: absolute`, or `top/left/right/bottom` — the **parent** controls placement.
- Props that control appearance must map to tokens: `size="lg"` ✅ — `padding="32px"` ❌

---

## 5. When a token doesn't exist

1. Add the token to the token file first.
2. Then use it in the component.
3. Never introduce a one-off value in a component "just this once."

---

## 6. Refactoring

- If you encounter hardcoded values in code you're touching, extract them to tokens in the same commit.
- Never introduce new violations to match surrounding code ("it was already like this" is not a justification).

---

## 7. Token efficiency

- **Plan first** — before any implementation, outline 3–5 steps. Prevents backtracking.
- **Read only what's relevant** — don't open files unrelated to the current task.
- **Modify, don't rewrite** — if a file is correct, don't rewrite it. Read → verify → change only what's needed. If a change affects other components, update those too.
- **No verbose confirmations** — don't summarize completed actions. Move to the next step or wait. Report errors clearly.
- **One file at a time** — complete all changes to one file before moving to the next.
- **Don't re-read loaded context** — if a file was already read this session, reference it by name.

---

## Checklist before writing code

- [ ] Every color, spacing, font-size, breakpoint, z-index → token?
- [ ] Every user-visible string → i18n?
- [ ] Every URL/path → config or route helper?
- [ ] New CSS rule avoidable with an existing token or utility?
- [ ] Component setting its own external margin/position?
- [ ] Any inline style or `!important`?

If any answer is "no" — fix it first.

---

## Quick reference

| Rule | Short form |
|---|---|
| Colors, spacing, font sizes, breakpoints, z-index | → token |
| Strings | → i18n |
| URLs & paths | → config/env/route |
| Magic numbers | → named constant |
| Inline styles | → class + token |
| Bare tag selectors outside base | → scoped styles |
| Component self-positioning | → parent controls placement |
| New value needed | → token file first |
| Before coding | → plan 3–5 steps |
| File already correct | → don't rewrite |
| Action completed | → no summary, move on |
| File already read | → reference by name |
