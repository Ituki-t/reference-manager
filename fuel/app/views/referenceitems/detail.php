<div class="row justify-content-center">
  <div class="col-lg-8">

    <div class="card shadow-sm">
      <div class="card-body">

        <h2 class="card-title mb-4">
          <?php echo e($reference_item['title']); ?>
        </h2>

        <table class="table table-borderless">

          <tr>
            <th>URL</th>
            <td>
              <span>
                <?php echo e($reference_item['url']); ?>
              </span>
              <a
                href="<?php echo e($reference_item['url']); ?>"
                target="_blank"
              >
                サイトを開く
              </a>
            </td>
          </tr>

          <?php if (!empty($tags)): ?>
            <tr>
              <th>タグ</th>
              <td>

                <?php foreach ($tags as $tag): ?>

                  <span class="badge bg-secondary">
                    <?php echo e($tag['name']); ?>
                  </span>

                <?php endforeach; ?>

              </td>
            </tr>
          <?php endif; ?>

          <tr>
            <th>登録日</th>
            <td>
              <?php echo e($reference_item['created_at']); ?>
            </td>
          </tr>

          <tr>
            <th>更新日</th>
            <td>
              <?php echo e($reference_item['updated_at']); ?>
            </td>
          </tr>

        </table>

        <div class="border rounded p-3 mb-4">

          <h5 class="mb-3">
            説明・メモ
          </h5>

          <p class="mb-0">
            <?php echo nl2br(e($reference_item['memo'])); ?>
          </p>

        </div>

        <div class="d-flex gap-2">

          <a
            href="<?php echo Uri::create('referenceitems/update/' . $reference_item['id']); ?>"
            class="btn btn-primary"
          >
            編集
          </a>

          <form
            action="<?php echo Uri::create('referenceitems/delete/' . $reference_item['id']); ?>"
            method="post"
            onsubmit="return confirm('本当に削除しますか？');"
          >
            <input
              type="submit"
              value="削除"
              class="btn btn-danger"
            >
          </form>

        </div>

      </div>
    </div>

  </div>
</div>
