---
description: Guided update of a fellowship page's Rich Text content and photo gallery (Traditional Chinese, English, Simplified Chinese)
argument-hint: "[fellowship page name or content path — optional]"
---

You are running the **Update Fellowship Page** workflow for this Kirby CMS church website. Guide the user, one step at a time, through updating a page's **Rich Text** section and its **photo gallery + captions** in all three languages. Follow the steps below in order. Do the interactive parts conversationally — ask, wait for the answer, then act.

## Conventions (read first)

- **Three languages, always**, each in its own content file:
  - Traditional Chinese → `church-page.zh-tw.txt`
  - English → `church-page.en.txt`
  - Simplified Chinese → `church-page.zh-cn.txt`
- **Language input is adaptive — the canonical order is Traditional Chinese → English → Simplified Chinese, but take whatever the user gives.** Users often paste **Traditional + English together**, or want to **write the English themselves**. So: accept any languages provided up front, then only prompt for the ones still missing (in the canonical order). For **English**, if it wasn't supplied, ask whether you should *draft it from the Traditional* or the user will *provide it themselves*. For **Simplified Chinese**, offer: *"Want me to convert it from the Traditional Chinese you gave?"* — if yes, produce the Simplified conversion yourself and show it for confirmation. Never invent a language the user hasn't confirmed.
- **Captions are short — be proactive.** For photo captions, if the user gives only the Traditional Chinese, don't ask for the other two one at a time: actively **propose both the English and the Simplified** translations yourself and show all three side by side for confirmation. (Longer Rich Text still follows the full sequence above.)
- Each content file has a `Builder:` field holding a **JSON array of blocks**. The common shape is: `hero → richtext → section-header (optional) → gallery *or* story-rows (optional) → cta`. Some pages are customised — work with whatever blocks exist.
- **Reference pages — pick the one that matches what you're building:**
  - Plain shape → **Ruth** (`content/6_fellowships/7_ruth/`): hero, one richtext, section-header, gallery, cta. This is what eight of the nine fellowship pages look like.
  - Photo-led shape → **Joseph** (`content/6_fellowships/4_joseph/`): several richtext blocks plus a `story-rows` block. Joseph is the most heavily customised page on the site — **do not assume it is typical.**
- **Every top-level block gets its own scroll-reveal.** `site/snippets/builder.php` wraps each block so it fades in as the visitor scrolls. Block *granularity* is therefore a content decision with a visible effect: one long block fades in as a single slab; three shorter blocks fade in one after another as the reader arrives at each. Prefer several purposeful blocks over one giant one.
- **Block order is the content decision that matters most, and there are two defensible orders.** Both are managing the same risk: how much text a visitor wades through before anything visually engaging appears.
  - **Facts-first** — `About Us → Meeting Time → Committee → photos → cta`. Practical info is easy to find near the top; photos reward the reader at the end.
  - **Photos-early** — `About Us → photos → Meeting Time → Committee → cta`. Puts something visual in front of the visitor before a long text run can lose them, and clusters the practical info directly above the CTA, so "when / where / who" sits right beside "get in touch". **This is what Joseph uses, deliberately.**

  Ask which the user prefers; don't assume. And note that either order is usually working around the same underlying problem — **a long opening text block**. If About Us runs past ~3 paragraphs, shortening it or pairing it with a photo helps more than reordering does (see Step 2).
- **Never touch** any `_changes/` folder (Kirby's unpublished Panel draft buffer). Never edit `media/` (auto-generated).
- **Preserve** every block's `id`, the page `Uuid`, image `Uuid`s, and all fields you're not explicitly changing. Only change what the step says.
- After any edit to a `.txt` file, the `Builder:` value must remain **valid JSON**. Validate before moving on (see Verify).
- Use each language's own text — never copy English into the Chinese files. Also watch for **stray English or editor's notes embedded in the Chinese input** (e.g. a "Bible study Thur. 7-9" line pasted into the Traditional text) — flag it and ask whether to render it properly in each language or drop it, rather than leaving English sitting in a Chinese file.
- **Cross-language consistency for proper names & rosters.** Personal names, leadership rosters, titles (牧師/傳道/Pastor/Preacher), and contact details are the most error-prone part. When the user supplies more than one language, **diff these across the versions before writing**; if they disagree (a name spelled with a different character, an extra/missing person, a title that doesn't match, a changed phone number), show a side-by-side and ask which is authoritative. Don't publish mismatched names across languages — unless the user explicitly says "leave as-is, no need to match."

## Step 0 — Identify the page

If the user passed an argument (`$ARGUMENTS`), treat it as the page name or content path and resolve it. Otherwise ask **"Which page do you want to edit?"**

Resolve to a content folder that contains `church-page.*.txt`. To help, you can list candidates:
```bash
find content -name "church-page.en.txt" | sed 's|/church-page.en.txt||' | sort
```
Confirm the resolved folder with the user before editing. Read all three `church-page.{zh-tw,en,zh-cn}.txt` files.

## Step 1 — Rich Text section

1. Find the block(s) with `"type":"richtext"` in the Builder. If there is more than one, show their `id`s and the leading `<h3>` of each, and ask which to update — or whether the new content replaces the whole set.
2. Tell the user you'll now collect the new Rich Text content. Take whatever languages they provide up front, then prompt only for the missing ones in canonical order (Traditional → English → Simplified). If English is missing, ask *draft-it-for-you vs. you-provide-it*; offer Simplified-from-Traditional conversion (see the adaptive-input convention above).
3. Accept their content as plain text/outline and format it to HTML using these **formatting rules**:
   - Section headings → `<h3>…</h3>`
   - Normal text → `<p>…</p>`
   - Bullet lists → `<ul><li>…</li></ul>` using **standard `<li>` only — NEVER put a `<p>` inside an `<li>`**. Inline emphasis is fine (`<strong>`, `<em>`, `<a href>`, `<br>`).
   - Keep it clean: no stray `&nbsp;` runs for alignment, no empty `<p></p>`/`<h3></h3>` at the end.
   - **Headings & typos:** if the opening text has no explicit heading but the page style uses one (e.g. About Us / 關於我們), add a fitting `<h3>` and tell the user. Silently fix obvious typos (e.g. 人仕→人士, a stray letter), but state what you changed.
   - **Opening line duplicates the hero title:** the pasted content usually opens with the group's own name (e.g. `路得婦女查經小組`, `以諾團契 (Enoch Fellowship)`, `"Men's Sky" Fellowship`), which already appears in the hero/header block. Don't repeat it as body text — treat it as the About Us section and use `關於我們 / About Us` as the `<h3>`. Tell the user you did this.
4. **Section-diff before overriding:** compare the new content's sections against the *current* richtext block. If a heading/section that exists now is absent from the new text (e.g. a Contact block), flag it and ask **keep-or-drop** before removing it — don't silently delete existing content. (A section that's merely *reorganized* — e.g. two old sections folded into one — is not a drop; note it, no need to ask.)
5. **Cross-language consistency check:** if the user supplied more than one language, diff the proper names, rosters, titles, and contact details across the versions (see the consistency convention above). Flag any mismatch and get the authoritative version before writing — unless the user says leave-as-is.
6. **Offer to split long text into one block per section.** Count the block-level elements (`<p>`, `<h3>`, `<li>`). If the result is **more than ~10 lines and has 2+ `<h3>` headings**, tell the user it would read better as one richtext block per `<h3>` and ask whether to split it. Say plainly why: each block fades in on its own as the reader scrolls, so three sections arrive in sequence instead of one wall landing at once. If they agree, emit one `richtext` block per section with ids `<page>-content-1`, `-2`, `-3` and **keep them adjacent in the Builder array** — consecutive richtext blocks are styled to sit as one continuous passage. If they decline, leave it as a single block.
7. **Preview before writing:** show the formatted result for all three languages as a readable rendering (not raw JSON) and get the user's confirmation. If you split, also show the resulting **block order** so the user can see where each section landed relative to the photos.
8. **Override** the richtext block's `text` field in each language file with that language's formatted HTML. Leave the block `id`, `type`, and all other blocks untouched. Remember the HTML is a JSON string value, so it must be properly escaped within the Builder JSON.
9. Re-serialize the Builder JSON and write each file.

> **Splicing blocks correctly.** When replacing one block with several, splice in place (`blocks[i:i+1] = new_blocks`) and then **re-read the file and print the resulting `id` order** to confirm. Do not trust that the splice landed where you intended — this has silently gone wrong before, putting sections after the photos instead of before them. See Verify step 2.

## Step 2 — Choose how the photos are presented

There are **two** ways to show a page's photos. Decide which before touching anything, and **ask the user** rather than defaulting.

| | `gallery` | `story-rows` |
|---|---|---|
| Layout | Uniform grid of captioned tiles | Full-width rows, photo alternating left/right, with a title + paragraph beside it |
| Each photo carries | A short label | A title **and** a description |
| Good for | Atmosphere shots, "here's what we look like", many photos | A handful of named activities that each deserve explaining |
| Rough limit | Any number | 4–7 rows; beyond that the page gets very tall |

**The decisive question: does each photo have something to *say*, and is that already written down somewhere on the page?**

**Look for duplication first — this is the strongest signal.** Read the richtext and the gallery captions together. If the richtext contains a list of named activities *and* the gallery captions repeat those same names, the page is saying everything twice with the words and the pictures pages apart. That is precisely what `story-rows` fixes: each photo is welded to its own description and the duplicated list is deleted. Joseph had exactly this — five bulleted activities and five identically-captioned photos — and converting it removed the duplication entirely.

If there is no such pairing (captions are just `合照`, `聚餐`, `2024 退修會`), keep the `gallery`. Don't convert a page to story-rows when there is nothing to write in the `text` field — empty rows look thin and unfinished.

**Ask the user like this:** *"This page has N photos. Their captions match the activity list in the text — do you want them as an alternating photo/text layout (each photo beside its own description, duplication removed), or keep the plain gallery grid?"*

### Does interleaving richtext and story-rows make sense?

**Not as a repeating rhythm — but one deliberate interleave is often the right answer.** Don't alternate text-block / photo-row / text-block all the way down. The text sections aren't parallel to the activities: *About Us* is narrative, while *Meeting Time* and *Committee Members* are reference data people scan for, and scattering those between photo rows makes them hard to find.

But a **single** photo break placed high up is genuinely useful, because it solves the real problem these pages have: **a long opening text block that visitors may abandon before they ever reach the photos.** The hero image doesn't fully cover this — it's backdrop, not evidence of a living group.

Three ways to fix a heavy opening, best first:

1. **Shorten About Us.** Three paragraphs is plenty. A reflective closing paragraph often works better as a pull-quote or moved further down. Fixing the cause beats rearranging around it.
2. **Lead row** — pair the About Us text with one good group photo as a single `story-rows` row, so a face appears immediately, beside the intro rather than after it. Keeps the factual sections in place.
3. **Move the photo block up**, above Meeting Time and Committee. This is the photos-early order (see Conventions). It works, and it puts the practical info next to the CTA — but it does push "when do they meet?" toward the bottom, so raise that tradeoff explicitly.

Offer these; don't apply any of them unasked.

### Which path to follow

- Page has, or should have, a **gallery** → Cases A / B / C below.
- Page should use **story-rows** → Case D.

Check whether the Builder has a `"type":"gallery"` block.

### Case A — the page already has a gallery
First, resolve **every** image in the gallery's `images` array (entries look like `file://<uuid>`) to its photo file by matching the `Uuid:` in the `*.en.txt` meta files:
```bash
grep -rl "^Uuid: <uuid>$" content/<page-folder>/*.en.txt
```
The photo is the file whose name is that meta filename minus the `.en.txt`.

**Handle all photos in one batch (don't go one-by-one):**
1. Show the user a table of **all** photos up front — number, local file path, and current Alt/Caption — and invite them to give every caption at once (e.g. one Traditional caption per photo).
2. When they reply with Traditional captions, **propose the English and Simplified** for the whole set in a single table for confirmation (per the caption convention above).
3. On confirmation, **override** the `Caption:` field in all three meta files for each photo (`<photo>.en.txt`, `<photo>.zh-cn.txt`, `<photo>.zh-tw.txt`):
   - Preserve every other field. **If a `.zh-cn`/`.zh-tw` meta file is missing, create it by mirroring the field set of that photo's existing `.en.txt`** (same fields, minus `Uuid` and `Template`), swapping in the translated `Caption`. Only fall back to the generic template below when no `.en.txt` exists — don't add fields the page doesn't already use.
4. When all photos are done, go to Verify.

### Case B — replace/swap a photo already in the gallery
When the user wants to swap out an existing gallery photo for a different image (they'll give you a source path), **do not** add a new gallery entry or mint a new UUID. Keep the slot in place:
1. Confirm the source file exists.
2. **Overwrite the existing photo file at its current filename** (`cp "<source-path>" "content/<page-folder>/<existing-filename>"`). Because the filename is unchanged, the meta files, the `Uuid`, and the `file://<uuid>` entry in the gallery's `images` array all stay valid and the gallery order is untouched.
   - If the new image should live under a different filename, that's effectively a remove+add — prefer the in-place overwrite unless the user asks otherwise, since it avoids touching the Builder.
3. **Refresh that photo's `Alt`** to describe the new image (the old Alt likely no longer fits), and set the `Caption:` in all three languages (create the `.zh-tw`/`.zh-cn` files if missing, per Case A step 3).
4. In Verify, confirm the new media path resolves — Kirby regenerates the thumbnail under a **new hash**, so the `/media/...` URL will differ from before; check it returns 200 and, if useful, that the pixel dimensions match the new source.

### Case C — the page has NO gallery (and no gallery Section Header)
Ask: **"This page has no gallery. Do you want me to create a photo gallery section for it?"**

If **no**, skip to Verify.

If **yes**:
1. Ask the user for the **gallery section title** in the language sequence (default suggestions: `相片集` / `Gallery` / `相册`; subtitle and link left empty, like Joseph).
2. Insert **two new blocks** into the Builder of all three language files, positioned **immediately before the `cta` block** (or appended at the end if there's no cta), mirroring Joseph:
   - Section Header:
     ```json
     {"content":{"title":"<title for this language>","subtitle":"","link_text":"","link_url":""},"id":"<page>-gallery-header","isHidden":false,"type":"section-header"}
     ```
   - Gallery (starts empty):
     ```json
     {"content":{"images":[],"caption":"","ratio":"4/3","crop":"true"},"id":"<page>-gallery","isHidden":false,"type":"gallery"}
     ```
   Use the same `id`s across all three languages.
3. **Handle photos in one batch, same as Case A** — don't loop one photo at a time. Ask the user for all the photo file paths they want to add (they'll often paste several at once with captions or context for each). For each source file, confirm it exists.
   - Before finalizing, **flag any photo that's a poor fit for a permanent gallery**: a flyer/poster with a specific date that will look stale once it passes, or an image with personal contact info (phone, WhatsApp, email) baked into the graphic itself. Note which photos this applies to and ask the user to confirm they still want it included — don't silently drop it, just make sure it's a deliberate choice.
   - Propose Traditional/English/Simplified captions for the whole set in a single table (per the caption convention above) and get confirmation before writing anything.
   - On confirmation, for each photo:
     - Copy it into the page folder with a clean, web-safe lowercase filename:
       ```bash
       cp "<source-path>" "content/<page-folder>/<safe-name>.<ext>"
       ```
     - Generate a **unique 16-char lowercase-alphanumeric UUID** and confirm it's unused:
       ```bash
       grep -rl "^Uuid: <uuid>$" content/ ; # must return nothing
       ```
     - Create the three meta files (see format below) with the captions, `Alt` set to the English caption, and (en only) the `Uuid` and `Template: image`.
   - Append **all** the new `"file://<uuid>"` entries to the gallery block's `images` array in **all three** language files in one pass.
   - Ask **"Add another photo, or are you done?"** in case there's a second batch. Repeat until done.

### Case D — story-rows (alternating photo / text)

Use when Step 2's decision landed on story-rows. The photo files, their meta files, `Uuid`s, and captions all work **exactly as in Cases A–C** — story-rows references images by `file://<uuid>` just like the gallery does. The only difference is the block, and where the descriptions live.

Block shape (`ratio` is one of `4/3`, `3/2`, `16/9`, `1/1`):

```json
{"content":{"ratio":"4/3","rows":[
  {"photo":["file://<uuid>"],"title":"<title>","text":"<description>"}
]},"id":"<page>-activities","isHidden":false,"type":"story-rows"}
```

Notes that matter:

- `photo` is an **array with one entry**, even though it is a single-file field.
- `text` is plain text (rendered through kirbytext), **not** HTML — no `<p>` wrappers.
- Photo sides alternate automatically from row order. There is no per-row left/right setting; reordering rows re-flips them.
- A row with an empty `text` renders as a title-only row and looks thin. If a language has no description for a row, **say so explicitly** rather than inventing copy or quietly translating from another language — ask the user to supply it.

Converting an existing gallery to story-rows:

1. Replace the `gallery` block **in place**, keeping its position and the `section-header` above it.
2. **Lift the descriptions from the richtext verbatim** — do not rewrite them. The words almost always already exist in the activity list you are about to delete.
3. Delete the now-duplicated list from the richtext, and confirm with the user before removing anything (Step 1's keep-or-drop rule still applies). If one listed item has **no** photo, it does not become a row — fold it into a nearby text section and tell the user where it went.
4. Row titles: prefer the **existing per-language photo captions**, which the user has already curated, over the headings in the bullet list. They sometimes differ, and the captions are usually the better-considered wording.
5. Do this in all three language files, with the **same block id and the same row order**.

### Image meta file format

> **Fallback only.** When a photo already has an `.en.txt`, mirror *its* field set instead of this template (see Case A step 3) — pages vary (some omit `Photographer`/`License`/`Link`). Use the format below only when creating a photo's meta files from scratch.

`<photo>.<ext>.en.txt` (default language — includes Uuid + Template):
```
Caption: <English caption>

----

Alt: <English caption>

----

Photographer: 

----

License: 

----

Link: 

----

Uuid: <uuid>

----

Template: image
```

`<photo>.<ext>.zh-cn.txt` and `<photo>.<ext>.zh-tw.txt` (translations — NO Uuid, NO Template):
```
Caption: <caption in that language>

----

Alt: <English caption>

----

Photographer: 

----

License: 

----

Link: 
```

## Verify (always do this at the end)

1. Validate the Builder JSON in each edited content file:
   ```bash
   php -r '$c=file_get_contents($argv[1]);$j=trim(explode("----",explode("Builder:",$c)[1])[0]);json_decode($j,true);echo $argv[1].": ".(json_last_error()===JSON_ERROR_NONE?"valid":"INVALID - ".json_last_error_msg())."\n";' <file>
   ```
2. **Print the resulting block order from the content file, for every language.** Parse the Builder JSON and list the `id`/`type` of each block in order — do **not** infer structure by grepping rendered HTML. A loose regex over the page source has produced a confidently wrong answer before, reporting three adjacent sections that were in fact split around the photos; the bug shipped. The JSON is the source of truth; the HTML is not.
   ```bash
   python3 -c "
   import json,re,sys
   raw=open(sys.argv[1],encoding='utf-8').read()
   b=json.loads(re.search(r'(?m)^Builder:\s*(.*?)\n\n----',raw,re.S).group(1))
   print(' → '.join(x['id'] for x in b))" <file>
   ```
   Confirm the order matches what you told the user, and that **all three languages agree**. Show it to them.
3. **Cross-language symmetry check.** Compare the three files for: same block count, same ids in the same order, same number of story-rows/gallery entries, and no field that is populated in one language but empty in another. Report any asymmetry — an empty `text` or `Caption` that is filled in elsewhere is nearly always an oversight, not a decision.
4. **Character-set check on the Simplified file.** `church-page.zh-cn.txt` should not contain Traditional-only characters (and vice versa). Mixed text has been found in this repo. Flag anything suspicious rather than silently converting it.
5. If the dev server is running (`http://localhost:8000`), curl the page in all three languages and confirm HTTP 200 and that the new content/captions appear. Start it with `composer start` if needed. **Check each language using that language's own expected strings** — e.g. don't grep Traditional characters against the Simplified page, or a real success will look like a gap. When grepping a caption, grep the **actual `Caption:` value**, not the photo's `Alt` — they often differ, and grepping the Alt by mistake makes a correct page look broken.
6. For any **new or swapped** photo, confirm its media URL resolves (curl the page and check the `/media/...` image path returns 200; a swapped photo will resolve under a new hash).
7. Summarize what changed. **Do not commit** — remind the user the changes are uncommitted, and follow the repo's commit rule (show the staged file list and wait for explicit confirmation before committing).

**State findings, not impressions.** When you report what you did, every structural claim (block order, counts, which language got what) must come from a command you actually ran against the content files in that same message. If you did not verify it, say you did not.

**The user may be editing in the Panel while you work.** The Panel writes to these same `.txt` files, so content can change underneath you mid-session — block reordering especially. Two consequences:

- Re-read a content file before your final verification rather than trusting an earlier reading.
- Before staging anything, diff against **`HEAD`**, never against a snapshot you took yourself — a self-taken snapshot cannot reveal a change that happened before you took it. Run `git diff HEAD -- content/<page-folder>/` and confirm every hunk is yours. If something is not, **show it to the user and ask** before committing; do not fold their edit into your commit silently. This has happened: a deliberate block reorder made in the Panel was committed under a message that never mentioned it.

## Guardrails

- **Work on `content/**` and photo files only.** Don't modify templates, blueprints, snippets, or CSS as part of this workflow. The maintainer has been explicit about this: layout intent on these pages should be expressed as block composition in the content, not as new logic under `site/`. Both `gallery` and `story-rows` already exist as blocks precisely so that no code is needed — if you find yourself wanting to add a field or a snippet, you are almost certainly reaching for something block composition can already do. Stop and ask.
- If a page's structure doesn't match the standard block order, adapt — but explain what you found before changing anything.
- **Source photos are served as generated thumbnails** (900px in the grid, 1800px to the lightbox), so a large original does not slow the page down. It does bloat the repo, though — anything over ~2 MB is worth downsizing before it is committed.
- Keep each interactive prompt short and answer the sequence explicitly (say which language you're asking for).
- **Dated or PII-bearing gallery photos:** before adding any new photo (Case A batch-add or Case C), check whether it's a flyer/poster carrying a specific date (will look stale once it passes) or personal contact info (phone, WhatsApp, email) baked into the image itself. Flag it and get explicit confirmation before including it — a permanent gallery isn't a great home for one-time event promos or exposed personal numbers.
