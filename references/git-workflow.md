# Git Workflow

Read this file before you open a PR.

## Branches

Work happens on a `type/short-slug` branch such as `fix/session-store-purge-falsy-key` or `chore/rector-null-coalescing-assign`, in a fork for outside contributors. The PR targets `main`, the default branch, and `v8` is a separate maintained line. Regeneration PRs from Fern come from `fern-bot/*` branches.

Never name a branch `release/*`. Merging a PR from a `release/` branch triggers `release.yml`, which publishes the package.

## PR titles

PR titles must follow [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/). Commit messages themselves do not matter because commits are squashed into the PR title. The allowed types from `CONTRIBUTING.md` are `feat`, `perf`, `refactor`, `build`, `ci`, `style`, `fix`, `security`, `docs` and `test`. Merged PRs also use `chore`, a `!` after the type for breaking changes such as `fix!:`, and `Release X.Y.Z` for release PRs.

## PR body

Follow `.github/PULL_REQUEST_TEMPLATE.md`. It has four sections, Changes, References, Testing and Contributor Checklist. Merged PRs usually write `N/A` under References and add two checkboxes under Testing, "This change adds unit test coverage" and "This change has been tested on the latest version of the platform/language". The template's Testing comment reminds you that new functionality needs tests and that 100% coverage is required.

Pull requests are reviewed only when they are marked ready for review, and CI must be green. Link related issues with `Closes #NNN` or `Related: #NNN`.
