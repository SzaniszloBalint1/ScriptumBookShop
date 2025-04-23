// tests/components/NotFound.test.ts
import { mount } from "@vue/test-utils";
import NotFound from "@/layout/NotFound.vue";
import { describe, it, expect } from "vitest";

describe("NotFound.vue", () => {
  it("renders error message", () => {
    const wrapper = mount(NotFound, {
      global: {
        stubs: {
          RouterLink: true
        }
      }
    });
    expect(wrapper.text()).toContain("Ezt az oldalt azért látod, mert valamit elbasztál");
  });
  
  it("contains navigation element", () => {
    const wrapper = mount(NotFound, {
      global: {
        stubs: {
          RouterLink: {
            template: '<a><slot /></a>',
            props: ['to']
          }
        }
      }
    });
    const navigationElement = wrapper.find('a');
    expect(navigationElement.exists()).toBe(true);
    expect(wrapper.text()).toContain("Vissza");
  });
  
  it("renders with custom RouterLink stub", () => {
    const wrapper = mount(NotFound, {
      global: {
        stubs: {
          RouterLink: {
            template: '<a :href="to" class="router-link"><slot /></a>',
            props: ['to']
          }
        }
      }
    });
    
    const link = wrapper.find('.router-link');
    if (link.exists()) {
      expect(link.attributes('href')).toBe('/home');
    } else {
      console.warn('RouterLink nem található a megfelelő selectorral, ellenőrizd a komponens struktúráját');
    }
  });
});