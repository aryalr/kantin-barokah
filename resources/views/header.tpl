<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|default:"POS App"}</title>
    {* ... semua link css dan style Anda ... *}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/pos-app/public"><i class="bi bi-cart-dash"></i> Kantin Berkah Barokah</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        {if isset($smarty.session.user)}
                            {* === Logika untuk Admin === *}
                            {if $smarty.session.user.role == 'admin'}
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'supplier'}active{/if}"
                                        href="?page=supplier"><i class="bi bi-truck"></i> Supplier</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'product'}active{/if}"
                                        href="?page=product"><i class="bi bi-box-seam"></i> Produk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'transaction'}active{/if}"
                                        href="?page=transaction"><i class="bi bi-cart-check"></i> Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'report'}active{/if}" href="?page=report"><i
                                            class="bi bi-graph-up"></i> Laporan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'users'}active{/if}" href="?page=users"><i
                                            class="bi bi-people"></i> Users</a>
                                </li>
                            {/if}

                            {* === Logika untuk Kasir === *}
                            {if $smarty.session.user.role == 'kasir'}
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'transaction'}active{/if}"
                                        href="?page=transaction"><i class="bi bi-cart-check"></i> Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {if isset($page) && $page == 'report'}active{/if}" href="?page=report"><i
                                            class="bi bi-graph-up"></i> Laporan</a>
                                </li>
                            {/if}
                        {/if} </ul>
                        {if isset($smarty.session.user)}
                            <span class="navbar-text ms-3">
                                Hi, {$smarty.session.user.username} |
                                <a class="ms-2" href="?page=logout">Logout</a>
                            </span>
                        {/if}
                </div>
            </div>
        </nav>
    </header>
<div class="container mt-4">