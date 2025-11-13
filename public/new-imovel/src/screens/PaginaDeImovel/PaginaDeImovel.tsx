import React, { useEffect, useMemo, useRef, useState } from "react";
import { Button } from "../../components/ui/button";
import { DescriptionSection } from "./sections/DescriptionSection";
import { FooterSection } from "./sections/FooterSection";
import { ImageGallerySection } from "./sections/ImageGallerySection";
import { PropertyDetailsSection } from "./sections/PropertyDetailsSection";

type PropertyDto = {
  id: number;
  title: string;
  slug: string;
  description?: string;
  price?: number;
  area?: number;
  bedrooms?: number;
  bathrooms?: number;
  garages?: number;
  city?: string;
  state?: string;
  address?: string;
  type?: { id?: number; name?: string; slug?: string };
  images?: string[];
  cover_url?: string | null;
  videos?: Array<{ provider?: string; url?: string; embed_url?: string; thumb_url?: string }>;
  media?: Array<{ type: 'image' | 'video'; id: number; is_cover?: boolean; sort?: number; src?: string; embed?: string; thumb?: string; url?: string }>;
};

const parseSlugFromPath = (): string | null => {
  const parts = window.location.pathname.split("/").filter(Boolean);
  if (parts.length >= 2 && parts[0] === "new-imovel") return parts[1];
  return null;
};

export const PaginaDeImovel = (): JSX.Element => {
  const [data, setData] = useState<PropertyDto | null>(null);
  const [error, setError] = useState<string | null>(null);
  const slug = useMemo(parseSlugFromPath, []);

  useEffect(() => {
    if (!slug) return;
    const controller = new AbortController();
    fetch(`/api/public/properties/${encodeURIComponent(slug)}`, {
      signal: controller.signal,
      headers: { Accept: "application/json" },
    })
      .then(async (r) => {
        if (!r.ok) throw new Error(`${r.status}`);
        return r.json();
      })
      .then((json: PropertyDto) => {
        setData(json);
        if (json.title) document.title = json.title;
      })
      .catch((e) => setError(e?.message ?? "Erro ao carregar imÃ³vel"));
    return () => controller.abort();
  }, [slug]);

  const media = (data?.media && data.media.length > 0)
    ? data.media
    : (data?.images ?? []).map((src, i) => ({ type: 'image' as const, id: i, src }));
  const coverIndex = useMemo(() => {
    const idx = media.findIndex((m) => m.is_cover);
    return idx >= 0 ? idx : 0;
  }, [media]);
  const [activeIndex, setActiveIndex] = useState<number>(0);
  useEffect(() => { setActiveIndex(coverIndex); }, [coverIndex]);
  const activeItem = media[activeIndex];

  // Modal de galeria (sem Bootstrap): abre sobreposto, com navegaÃ§Ã£o e teclado
  const [isModalOpen, setModalOpen] = useState(false);
  const [modalIndex, setModalIndex] = useState(0);
  const openModalAt = (idx: number) => { setModalIndex(idx); setModalOpen(true); };
  const closeModal = () => setModalOpen(false);
  const nextModal = () => setModalIndex((i) => (i + 1) % (media.length || 1));
  const prevModal = () => setModalIndex((i) => (i - 1 + (media.length || 1)) % (media.length || 1));
  useEffect(() => {
    if (!isModalOpen) return;
    const onKey = (e: KeyboardEvent) => {
      if (e.key === 'Escape') closeModal();
      if (e.key === 'ArrowRight') nextModal();
      if (e.key === 'ArrowLeft') prevModal();
    };
    window.addEventListener('keydown', onKey);
    document.body.style.overflow = 'hidden';
    return () => {
      window.removeEventListener('keydown', onKey);
      document.body.style.overflow = '';
    };
  }, [isModalOpen, media.length]);

  // Carrossel de miniaturas
  const thumbsRef = React.useRef<HTMLDivElement>(null);
  const [canPrev, setCanPrev] = useState(false);
  const [canNext, setCanNext] = useState(false);
  const updateArrows = () => {
    const el = thumbsRef.current; if (!el) return;
    const max = el.scrollWidth - el.clientWidth - 1;
    setCanPrev(el.scrollLeft > 0);
    setCanNext(el.scrollLeft < max);
  };
  useEffect(() => { updateArrows(); }, [media.length]);
  const scrollThumbs = (dir: 'prev' | 'next') => {
    const el = thumbsRef.current; if (!el) return;
    const view = el.clientWidth; const max = el.scrollWidth - view;
    const target = Math.max(0, Math.min(el.scrollLeft + (dir === 'next' ? view : -view), max));
    el.scrollTo({ left: target, behavior: 'smooth' });
  };
  useEffect(() => {
    const el = thumbsRef.current; if (!el) return;
    const onScroll = () => updateArrows();
    el.addEventListener('scroll', onScroll, { passive: true });
    return () => el.removeEventListener('scroll', onScroll);
  }, [thumbsRef.current]);
  const handleWheel = (e: React.WheelEvent) => {
    const el = thumbsRef.current; if (!el) return;
    if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) { el.scrollLeft += e.deltaY; e.preventDefault(); }
  };

  return (
    <div className="bg-white w-full min-h-screen relative flex flex-col overflow-x-hidden" data-model-id="153:7">
      <section className="w-full relative translate-y-[-1rem] animate-fade-in opacity-0">
        <ImageGallerySection />
      </section>

      <section className="w-full relative px-[30px] mt-8 translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms]">
        <div className="flex gap-8">
          <div className="flex-1">
            <div
              className="w-full max-w-[634px] h-auto rounded-[10px] overflow-hidden cursor-pointer"
              onClick={() => openModalAt(activeIndex)}
              title="Clique para ampliar"
            >
              {activeItem?.type === 'video' && (activeItem.embed || activeItem.url) ? (
                activeItem.embed ? (
                  <div className="aspect-video w-full">
                    <iframe
                      src={activeItem.embed}
                      title={data?.title ?? 'VÃ­deo do imÃ³vel'}
                      className="w-full h-full"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      allowFullScreen
                    />
                  </div>
                ) : (
                  <video className="w-full h-full" controls src={activeItem.url} preload="metadata" />
                )
              ) : (
                <img className="w-full h-auto object-cover" alt={data?.title ?? 'Imagem'} src={activeItem?.src || data?.cover_url || "https://c.animaapp.com/mht9bn8iNrOJ7D/img/rectangle-27.png"} />
              )}
            </div>

            <div className="mt-8 relative w-full">
              <img className="absolute left-1 top-1/2 -translate-y-1/2 w-11 h-11 cursor-pointer" onClick={() => scrollThumbs('prev')} alt="Anterior" src="https://c.animaapp.com/mht9bn8iNrOJ7D/img/group-14.png" />

              <div className="w-full overflow-hidden">
                <div ref={thumbsRef} className="flex gap-4 w-max px-12 overflow-x-auto scroll-smooth snap-x" onWheel={handleWheel}>
                  {(media.length ? media : [
                { type: 'image', id: 0, src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/rectangle-28.png" },
                { type: 'image', id: 1, src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/rectangle-29.png" },
                { type: 'image', id: 2, src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/rectangle-30.png" },
                { type: 'image', id: 3, src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/rectangle-31.png" },
              ]).map((m, index) => {
                const thumb = m.type === 'video' ? (m.thumb || m.src) : m.src;
                return (
                  <img
                    key={`gallery-${index}-${m.type}`}
                    className={`w-[161px] h-[100px] rounded-[10px] object-cover cursor-pointer flex-shrink-0 snap-start ${index===activeIndex ? 'ring-2 ring-red-700' : ''}`}
                    alt={data?.title ?? 'MÃ­dia'}
                    src={thumb || "https://c.animaapp.com/mht9bn8iNrOJ7D/img/rectangle-28.png"}
                    onClick={() => openModalAt(index)}
                  />
                );
              })}
                </div>
              </div>

              <img className="absolute right-1 top-1/2 -translate-y-1/2 w-11 h-11 cursor-pointer" onClick={() => scrollThumbs('next')} alt="Próximo" src="https://c.animaapp.com/mht9bn8iNrOJ7D/img/group-15.png" />
            </div>
          </div>
          <div className="flex-1 max-w-[689px]">
            <DescriptionSection
              title={data?.title ?? "ImÃ³vel"}
              subtitle={data ? `${data.city ?? ""}${data.state ? ` - ${data.state}` : ""}` : undefined}
              ctaHref="#"
              ctaLabel="Falar com Catia"
            />
          </div>
        </div>
      </section>

      <section className="w-full relative px-[30px] mt-8 translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms]">
        <PropertyDetailsSection
          city={data?.city}
          area={data?.area}
          bedrooms={data?.bedrooms}
          bathrooms={data?.bathrooms}
          garages={data?.garages}
          price={data?.price}
        />
      </section>
      <section className="w-full relative px-[30px] mt-8 translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:600ms]">
        <div className="max-w-[1383px] mx-auto">
          <div className="[font-family:'Roboto',Helvetica] font-normal text-[#555555] text-lg tracking-[0] leading-[25px]">
            {error && <div className="text-red-600">{error}</div>}
            {data?.description && (
              data.description.split(/\n\n+/).map((paragraph, index) => (
                <div key={`paragraph-${index}`} className="mb-4 whitespace-pre-line">
                  {paragraph}
                </div>
              ))
            )}
          </div>
        </div>
      </section>

      <section className="w-full relative mt-8 translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:800ms]">
        <FooterSection />
      </section>

      {/* Modal de galeria */}
      <div className={`fixed inset-0 z-[9999] ${isModalOpen ? '' : 'hidden'}`}>
        <div className="absolute inset-0 bg-black/80" onClick={closeModal} />
        <div className="absolute inset-0 flex items-center justify-center p-4">
          <div className="relative w-full max-w-5xl max-h-[88vh] bg-black rounded-md overflow-hidden">
            {/* Controles do modal */}
            <button onClick={closeModal} aria-label="Fechar" className="absolute top-2 right-2 bg-white/20 hover:bg-white/30 text-white rounded px-3 py-1 z-10">Fechar</button>
            <button onClick={prevModal} aria-label="Anterior" className="absolute left-2 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full w-10 h-10 flex items-center justify-center z-10"><span aria-hidden="true">&#8249;</span></button>
            <button onClick={nextModal} aria-label="Próximo" className="absolute right-2 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full w-10 h-10 flex items-center justify-center z-10"><span aria-hidden="true">&#8250;</span></button>
            {/* Conteúdo */}
            <div className="w-full h-full flex items-center justify-center">
              {media[modalIndex]?.type === 'video' ? (
                media[modalIndex].embed ? (
                  <div className="aspect-video w-full">
                    <iframe
                      src={media[modalIndex].embed as string}
                      title={data?.title ?? 'VÃ­deo do imÃ³vel'}
                      className="w-full h-full"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      allowFullScreen
                    />
                  </div>
                ) : (
                  <video className="max-h-[88vh] w-auto" controls src={media[modalIndex].url} preload="metadata" />
                )
              ) : (
                <img
                  src={media[modalIndex]?.src || data?.cover_url || ''}
                  alt={data?.title ?? 'MÃ­dia'}
                  className="max-h-[88vh] w-auto"
                />
              )}
            </div>

            {/* Faixa de miniaturas removida por solicitação */}
          </div>
        </div>
      </div>
    </div>
  );
};




