<div class="hero-section">
    <h1><?= $heroTitle ?? 'Welcome to Internships Management' ?></h1>
    <p><?= $heroSubtitle ?? 'Find the perfect internship opportunity for your career growth' ?></p>
    
    <?php if (isset($featuredInternships) && count($featuredInternships) > 0): ?>
        <div class="featured-internships">
            <h2>Featured Internships</h2>
            <div class="internship-grid">
                <?php foreach ($featuredInternships as $internship): ?>
                    <div class="internship-card">
                        <h3><?= $internship['title'] ?></h3>
                        <p class="company"><?= $internship['company'] ?></p>
                        <p class="location"><?= $internship['location'] ?></p>
                        <a href="/internships/<?= $internship['id'] ?>" class="button">View Details</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="statistics-section">
    <div class="stat-item">
        <h3><?= $stats['internships'] ?? '500+' ?></h3>
        <p>Internships</p>
    </div>
    <div class="stat-item">
        <h3><?= $stats['companies'] ?? '200+' ?></h3>
        <p>Companies</p>
    </div>
    <div class="stat-item">
        <h3><?= $stats['students'] ?? '1000+' ?></h3>
        <p>Students</p>
    </div>
</div>

<?php if (isset($recentBlog) && count($recentBlog) > 0): ?>
<div class="blog-section">
    <h2>Latest Articles</h2>
    <div class="blog-grid">
        <?php foreach ($recentBlog as $post): ?>
            <div class="blog-card">
                <h3><?= $post['title'] ?></h3>
                <p class="date"><?= $post['date'] ?></p>
                <p class="excerpt"><?= $post['excerpt'] ?></p>
                <a href="/blog/<?= $post['slug'] ?>" class="read-more">Read More</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
